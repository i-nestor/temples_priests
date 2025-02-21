<?php

namespace App\Http\Controllers;

use App\Models\ElderFounder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ElderFounderController extends Controller {

    public function index(): View {
        $elder_founders = ElderFounder::with("author")->orderBy('secondname')
            ->filter(request(["search", "abc"]))
            ->paginate(25)->withQueryString();
        return view('elder-founders.elder-founders', ["elder_founders" => $elder_founders]);
    }

    public function show(ElderFounder $elder_founder): View {
        return view('elder-founders.elder-founder', ["elder_founder"  => $elder_founder]);
    }

}
