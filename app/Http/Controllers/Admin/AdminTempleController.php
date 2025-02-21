<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temple;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminTempleController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index(): View {
        $temples = auth()->user()->temples()->orderBy('shortname')
            ->filter(request(["search", "abc"]))
            ->paginate(25)->withQueryString();
        return view('admin.temples.index', ['temples' => $temples]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        return view('admin.temples.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Temple $temple
     * @return RedirectResponse
     */
    public function store(Request $request, Temple $temple): RedirectResponse {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'shortname' => 'required|max:255',
            'slug' => 'required|unique:temples',
            'image' => 'image|file|max:1024',
            'description' => 'required'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('temple-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Temple::create($validatedData);
        return redirect()->to('/admin/temples')->with('success', 'Храм(монастырь) был добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param Temple $temple
     * @return View
     */
    public function show(Temple $temple): View {
        return view('admin.temples.show', ['temple' => $temple]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Temple $temple
     * @return View
     */
    public function edit(Temple $temple): View {
        return view('admin.temples.edit', ['temple' => $temple]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Temple $temple
     * @return RedirectResponse
     */
    public function update(Request $request, Temple $temple): RedirectResponse {
        $rules = [
            'name' => 'required|max:255',
            'shortname' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'description' => 'required'
        ];

        if ($request->slug !== $temple->slug) {
            $rules['slug'] = 'required|unique:temples';
        }

        $validatedData = $request->validate($rules);

        $postOldImage = $request->post('old-image');
        $hasFileImage = $request->hasFile('image');

        if ($postOldImage) {
            Storage::delete($postOldImage);
        }

        if ($hasFileImage) {
            $validatedData['image'] = $request->file('image')->store('temple-images');
        } else {
            $validatedData['image'] = null;
        }

        $validatedData['user_id'] = auth()->user()->id;
        $temple->where('id', $temple->id)->update($validatedData);

        return redirect()->to('/admin/temples')->with('success', 'Информация о храме (монастыре) была обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Temple $temple
     * @return RedirectResponse
     */
    public function destroy(Temple $temple): RedirectResponse {
        if ($temple->image) {
            Storage::delete($temple->image);
        }
        $temple->delete();
        return redirect()->to('/admin/temples')->with('success', 'Храм (монастырь) был удалён');
    }

    public function slug(): JsonResponse {
        $slug = Str::of(request('name'))->slug()->value;
        while (true) {
            $temple = Temple::query()->where('slug', '=', $slug)->get();
            if ($temple->isNotEmpty()) {
                $slug .= '-' . Str::lower(Str::random(5));
                continue;
            } else { break; }
        }
        return response()->json(["slug" => $slug]);
    }
}
