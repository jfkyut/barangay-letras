<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeSessionTypeController extends Controller
{
    public function index(Request $request)
    {
        $sessionTypes = \App\Models\OfficeSession\OfficeSessionType::all();
        
        return response()->json([
            'session_types' => $sessionTypes
        ]);
    }
}
