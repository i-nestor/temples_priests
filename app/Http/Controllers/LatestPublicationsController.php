<?php

namespace App\Http\Controllers;

use App\Models\ElderFounder;
use App\Models\Priest;
use App\Models\Temple;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class LatestPublicationsController extends Controller {

    public function index(): View {

        // публикации за последний месяц
        $lastMonth = Carbon::now()->copy()->subMonth();

        $temples = Temple::where('updated_at', '>=', $lastMonth)->orderBy('updated_at', 'desc')->get();
        $priests = Priest::where('updated_at', '>=', $lastMonth)->orderBy('updated_at', 'desc')->get();
        $elder_founders = ElderFounder::where('updated_at', '>=', $lastMonth)->orderBy('updated_at', 'desc')->get();

        return view('latest-publications', compact('temples', 'priests', 'elder_founders'));
    }
}
