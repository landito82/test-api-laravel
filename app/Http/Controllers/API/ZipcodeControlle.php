<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zipcode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ZipcodeControlle extends Controller
{    
    /**
     * Display the specified resource.
     *
     * @param  int  $zip_code
     * @return \Illuminate\Http\Response
     */
    public function show($zip_code)
    {
        $zipcode = Zipcode::where('d_codigo','=',$zip_code)->first();

        foreach ($zipcode->zipcode->sttlements as $sttlement) {
            $sttlements[] = array(
                'key' => $sttlement->id_asenta_cpcons,
                'name' => Str::upper(Str::ascii($sttlement->d_asenta)),
                'zone_type' => Str::upper(Str::ascii($sttlement->d_zona)),
                'settlement_type' => array('name' => $sttlement->d_tipo_asenta)
            );
        }
        
        return response() -> json([
            'zip_code' => (string)sprintf("%05d", $zipcode->d_codigo),
            'locality' => Str::upper(Str::ascii($zipcode->d_ciudad)),
            'federal_entity' => [
                'key' => $zipcode->c_estado,
                'name' => Str::upper(Str::ascii($zipcode->d_estado)),
                'code' => $zipcode->c_CP
            ],
            'settlements' => $sttlements,
            'municipality' => [
                'key' => $zipcode->c_mnpio,
                'name' => Str::upper(Str::ascii($zipcode->D_mnpio))
            ]
        ]);
    }
}
