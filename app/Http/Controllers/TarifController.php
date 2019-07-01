<?php

namespace App\Http\Controllers;

use App\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use response;

class TarifController extends Controller
{
    public function create(Request $request)
    {
        if( Auth::user()->role_id == 1 ){
            $tarif = Tarif::create([
                'name'=>$request->name,
                'service'=>$request->service,
                'min'=>$request->min,
                'max'=>$request->max,
                'unit_price'=>$request->unit_price,
            ]);
            if ($tarif){
                return response()->json($tarif);
            }
        }else{
            return view('auth.login');
        }
    }
    public function checkRange(Request $request) {
        $tarifs = Tarif::where('service', $request->service)->get();
        foreach ($tarifs as $tarif){
            if (($request->min >= $tarif->min) and ($request->min <= $tarif->max)){
                return response()->json(['error'=>"Ooops!!! range already exist"]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if ( Auth::user()->role_id == 1 ){
            $tarifs = Tarif::all();
            return view('tarifs.index',['tarifs'=>$tarifs]);
        }else{
            return view('auth.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user()->role_id == 1){
            $tarif = Tarif::find($request->tarif_id)->update([
                'name'=>$request->name,
                'service'=>$request->service,
                'min'=>$request->min,
                'max'=>$request->max,
                'unit_price'=>$request->unit_price,
            ]);
            if ( $tarif ){
                $tarif = Tarif::where('id', $request->tarif_id)->first();
                return response()->json($tarif);
            }
        }else{
            return view("auth.login");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function deleteTarif(Request $request)
    {
            $delete = Tarif::destroy($request->tarif);

            if ($delete){
                return response()->json($delete);
            }else{
                return redirect()->route('tarifs.index')->with('error',"Error can't delete Contact ");
            }
    }
}
