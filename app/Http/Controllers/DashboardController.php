<?php

namespace App\Http\Controllers;

use App\Models\Values;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function show(){
        $data = DB::table("values")
            ->select("*")
            ->orderBy("date")
            ->orderBy("value")
            ->get();

        $values = new Values($data);

        return view('dashboard', ["values" => $values]);
    }

    public function process(){
        return redirect("dashboard");
    }

}
