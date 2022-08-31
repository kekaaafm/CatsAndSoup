<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function show(?string $date = null)
    {
        $date = new Carbon($date);
        $dataset = new Dataset($date);

        return view('dashboard', ["dataset" => $dataset]);
    }

    public function process(){
        return redirect("dashboard");
    }

}
