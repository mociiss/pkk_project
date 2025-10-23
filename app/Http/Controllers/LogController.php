<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        $logactivity = Log::orderBy('log_name')->get();
        return view('log.index', compact('logactivity'));
    }
}
