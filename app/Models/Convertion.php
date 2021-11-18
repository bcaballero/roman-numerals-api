<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Convertion extends Model
{
    use HasFactory;

    protected $fillable = ['intval', 'roman'];

    public static function list()
    {
        return self::orderBy('id','DESC')->get();
    }

    public static function top()
    {
        return self::select(DB::raw('`intval` AS `integer`,max(`roman`) AS `roman_numeral`,count(*) AS `times_converted`'))
                ->groupBy('intval')
                ->orderBy(DB::raw('count(*)'),'DESC')
                ->limit(10)
                ->get();
    }
}
