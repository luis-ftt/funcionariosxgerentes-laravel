<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function logs(){
        $logs = Log::paginate(10);
        return view('logs', ['logs' => $logs]);   
    }
}
