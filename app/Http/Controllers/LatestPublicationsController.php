<?php

namespace App\Http\Controllers;

use App\Models\ElderFounder;
use App\Models\Priest;
use App\Models\Temple;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class LatestPublicationsController extends Controller {

    public function index(): View { // для админки не делать только для посетителей

        $lastMonth = Carbon::now()->copy()->subMonth();

        $temples = Temple::where('updated_at', '>=', $lastMonth)->orderBy('updated_at', 'DESC')->get();
        $priests = Priest::where('updated_at', '>=', $lastMonth)->orderBy('updated_at', 'DESC')->get();
        $elder_founders = ElderFounder::where('created_at', '>=', $lastMonth)->orderBy('updated_at', 'DESC')->get();

        return view('latest-publications', compact('temples', 'priests', 'elder_founders'));

    }
}
