<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Priest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminPriestController extends Controller {

    /**
     * Показать список записей
     */
    public function index(): View {
        $priests = auth()->user()->priests()->orderBy('secondname')
            ->filter(request(["search", "abc"]))
            ->paginate(25)->withQueryString();
        return view('admin.priests.index', ['priests' => $priests]);
    }

    /**
     * Показать форму создания записи
     */
    public function create(): View {
        return view('admin.priests.create' );
    }

    /**
     * Сохранить новую запись
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {

        $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'secondname' => 'required|max:255',
            'slug' => 'required|unique:priests',
            'image' => 'image|file|max:360', // 360x480 (3x4)
            'biography' => 'required'
        ]);

        if($request->file('image')) {
          $validatedData['image'] = $request->file('image')->store('priest-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Priest::create($validatedData);
        return redirect()->to('/admin/priests')->with('success', 'Священник был добавлен');
    }

    /**
     * Отобразить запись
     *
     * @param Priest $priest
     * @return View
     */
    public function show(Priest $priest): View {
        return view('admin.priests.show', ['priest' => $priest]);
    }

    /**
     * Показать форму редактирования записи
     *
     * @param Priest $priest
     * @return View
     */
    public function edit(Priest $priest): View {
        return view('admin.priests.edit', ['priest' => $priest]);
    }

    /**
     * Обновить запись
     *
     * @param Request $request
     * @param Priest $priest
     * @return RedirectResponse
     */
    public function update(Request $request, Priest $priest): RedirectResponse {
        $rules = [
            'firstname' => 'required|max:255',
            'secondname' => 'required|max:255',
            'image' => 'image|file|max:512',
            'biography' => 'required'
        ];

        if ($request->slug !== $priest->slug) {
            $rules['slug'] = 'required|unique:priests';
        }

        $validatedData = $request->validate($rules);

        $postOldImage = $request->post('old-image');
        $hasFileImage = $request->hasFile('image');

        if ($postOldImage) {
            Storage::delete($postOldImage);
        }

        if ($hasFileImage) {
            $validatedData['image'] = $request->file('image')->store('priest-images');
        } else {
            $validatedData['image'] = null;
        }

        $validatedData['user_id'] = auth()->user()->id;

        $priest->where('id', $priest->id)->update($validatedData);
        return redirect()->to('/admin/priests')->with('success', 'Информация о священнослужителе была обновлена');
    }

    /**
     * Удалить запись
     *
     * @param Priest $priest
     * @return RedirectResponse
     */
    public function destroy(Priest $priest): RedirectResponse {
        if ($priest->image) Storage::delete($priest->image);
        $priest->delete();
        return redirect()->to('/admin/priests')->with('success', 'Священнослужитель был удалён');
    }

    /**
     * Возвращает слаг записи
     * @return JsonResponse
     */
    public function slug(): JsonResponse {

        $slug = Str::of(request('secondname'))->slug()->value;
        while (true) {
            $priest = Priest::query()->where('slug', '=', $slug)->get();
            if ($priest->isNotEmpty()) {
                $slug .= '-' . Str::lower(Str::random(5));
                continue;
            } else { break; }
        }
        return response()->json(["slug"  => $slug]);
    }

}
