<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ElderFounder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminElderFounderController extends Controller {

    /**
     * Показать список записей
     */
    public function index(): View {
        $elder_founders = auth()->user()->elder_founders()->orderBy('secondname')
            ->filter(request(["search", "abc"]))->paginate(25)->withQueryString();
        return view('admin.elder-founders.index', ['elder_founders' => $elder_founders]);
    }

    /**
     * Показать форму создания записи
     */
    public function create(): View {
        return view('admin.elder-founders.create' );
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
            'slug' => 'required|unique:elder_founders',
            'image' => 'image|file|max:512',
            'biography' => 'required'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('elder-founder-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        ElderFounder::create($validatedData);
        return redirect()->to('/admin/elder-founders')->with('success', 'Человек был добавлен');
    }

    /**
     * Отобразить запись
     *
     * @param ElderFounder $elder_founder
     * @return View
     */
    public function show(ElderFounder $elder_founder): View {
        return view('admin.elder-founders.show', ['elder_founder' => $elder_founder]);
    }

    /**
     * Показать форму редактирования записи
     *
     * @param ElderFounder $elder_founder
     * @return View
     */
    public function edit(ElderFounder $elder_founder): View {
        return view('admin.elder-founders.edit', ['elder_founder' => $elder_founder]);
    }

    /**
     * Обновить запись
     *
     * @param Request $request
     * @param ElderFounder $elder_founder
     * @return RedirectResponse
     */
    public function update(Request $request, ElderFounder $elder_founder) : RedirectResponse {
        $rules = [
            'firstname' => 'required|max:255',
            'secondname' => 'required|max:255',
            'image' => 'image|file|max:512',
            'biography' => 'required'
        ];

        if ($request->slug !== $elder_founder->slug) {
            $rules['slug'] = 'required|unique:elder_founders';
        }

        $validatedData = $request->validate($rules);

        $postOldImage = $request->post('old-image');
        $hasFileImage = $request->hasFile('image');

        if ($postOldImage) {
            Storage::delete($postOldImage);
        }

        if ($hasFileImage) {
            $validatedData['image'] = $request->file('image')->store('elder-founder-images');
        } else {
            $validatedData['image'] = null;
        }

        $validatedData['user_id'] = auth()->user()->id;

        $elder_founder->where('id', $elder_founder->id)->update($validatedData);
        return redirect()->to('/admin/elder-founders')->with('success', 'Информация о человеке была обновлена');
    }

    /**
     * Удалить запись
     *
     * @param ElderFounder $elder_founder
     * @return RedirectResponse
     */
    public function destroy(ElderFounder  $elder_founder): RedirectResponse {
        if ($elder_founder->image) Storage::delete($elder_founder->image);
        $elder_founder->delete();
        return redirect()->to('/admin/elder-founders')->with('success', 'Человек был удалён');
    }

    /**
     * Возвращает слаг записи
     * @return JsonResponse
     */
    public function slug(): JsonResponse {

        $slug = Str::of(request('secondname'))->slug()->value;
        while (true) {
            $elder_founder = ElderFounder::query()->where('slug', '=', $slug)->get();
            if ($elder_founder->isNotEmpty()) {
                $slug .= '-' . Str::lower(Str::random(5));
                continue;
            } else { break; }
        }
        return response()->json(["slug"  => $slug]);
    }
}
