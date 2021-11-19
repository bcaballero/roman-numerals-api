<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\RomanNumeralConverter;

use App\Models\Convertion;

class RomanController extends Controller
{
    private RomanNumeralConverter $converter;

    public function index()
    {
        return response()->json(Convertion::list(),200);
    }

    public function convert(Request $request)
    {

        $this->converter = new RomanNumeralConverter();

        $validator = Validator::make($request->all(), [
            'number' => 'required|integer|min:1|max:3999'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 400);
        }

        $roman_numeral = $this->converter->convertInteger($request->number);

        $convertion = Convertion::create([
            'intval'   => $request->number,
            'roman'     => $roman_numeral
        ]);   
        
        return response()->json([
            'roman_numeral' => $convertion->roman
        ], 201);
    }

    public function top()
    {
        return response()->json(Convertion::top(),200);
    }
}
