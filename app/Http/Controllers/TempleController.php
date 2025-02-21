<?php

namespace App\Http\Controllers;

use App\Models\Temple;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TempleController extends Controller {

    public function index(): View {
        $temples = Temple::with("author")->orderBy('shortname')
            ->filter(request(["search", "abc" /*, 'author'*/]))
            ->paginate(25)->withQueryString();
        return view('temples.temples', ["temples" => $temples]);
    }

    public function show(Temple $temple): View {
        return view('temples.temple', ["temple"  => $temple]);
    }
}
