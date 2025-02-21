<?php

namespace App\Http\Controllers;

use App\Models\Priest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PriestController extends Controller {

    public function index(): View {
        $priests = Priest::with("author")->orderBy('secondname')
            ->filter(request(["search", "abc" /*, 'author'*/]))
            ->paginate(25)->withQueryString();
        return view('priests.priests', ["priests" => $priests]);
    }

    public function show(Priest $priest): View {
        return view('priests.priest', ["priest"  => $priest]);
    }
}
