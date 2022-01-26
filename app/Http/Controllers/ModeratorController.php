<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatisticsCategory;

class ModeratorController extends Controller
{
    public function index()
    {
        return view('moderator.index');
    }

    public function statsReduction()
    {
        $stats = StatisticsCategory::get();

        foreach($stats as $stat)
        {
            $stat->stats = round($stat->stats * 0.2, 0);
            $stat->save();
        }

    }
}
