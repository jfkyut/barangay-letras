<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouncilController extends Controller
{
    public function index(Request $request)
    {
        $councils = \App\Models\Council\Council::latest()->get();
        
        return response()->json([
            'councils' => $councils,
        ]);
    }
}
