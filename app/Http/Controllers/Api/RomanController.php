<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Convertion;

class RomanController extends Controller
{
    public function index()
    {
        return response()->json(Convertion::all(),200);
    }

    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|integer|min:1|max:3999'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 400);
        }

        $roman_numeral = convert_roman($request->number);

        $convertion = Convertion::create([
            'integer'   => $request->number,
            'roman'     => $roman_numeral
        ]);   
        
        return response()->json([
            'roman_numeral' => $convertion->roman
        ], 201);
    }
}
