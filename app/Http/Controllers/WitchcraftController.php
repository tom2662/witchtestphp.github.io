<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WitchcraftController extends Controller
{

    public function KillAverage(Request $request){

        $Yoda = $request->yoda;
        $Aoda = $request->aoda;
        $Yodb = $request->yodb;
        $Aodb = $request->aodb;

        if (($Yoda< 0) || ($Aoda< 0)|| ($Yodb< 0)||($Aodb< 0)) {
            $res = -1;
            return $res;
        } else {
            $ra = ($Yoda - $Aoda) !== 0 ? $this->KillSpell($Yoda - $Aoda) : $this->KillSpell(1);
            $rb = ($Yodb - $Aodb) !== 0 ? $this->KillSpell($Yodb - $Aodb) : $this->KillSpell(1);
            $res = floatval($ra+$rb) / 2;
            return $res;
        }
        

        return response()->json($res);
    }

       
    private function KillSpell($year){

        $bowl =  array();

        for ($i = 0; $i < $year; $i++) {
            if ($i == 0) {
                $bowl[] = 1;
            } else {
                $onion = $bowl[$i-1] + $this->Mantra($i);
                $bowl[] = $onion;
            }

        }
        return $bowl[count($bowl)-1];
    }


    private function Mantra($y) 
    {
        $x = array();

                for( $i = 0; $i <= $y; $i++) {

                    if ( $i > 2) {
                        $r = $x[$i-1] + $x[$i-2];
                        $x[] = $r;
                    } else {

                        $x[] = $i;
                    }

                }
        return $x[count($x)-1];
    }
}
