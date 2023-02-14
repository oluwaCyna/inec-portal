<?php

namespace App\Http\Controllers;

use App\Models\AgentName;
use App\Models\Lga;
use App\Models\PollingUnit;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function unitResult () 
    {
        return view('unit-result');
    }

    public function totalResult () 
    {
        return view('total-result');
    }

    public function addResult () 
    {
        return view('add-result');
    }

  public function lgaRequest(Request $request)
  {
    //if required fields are received, and not empty
    if($request->has(['id']) && $request->id!=null){
        $lga = Lga::where('state_id', $request->id)->get();
      return response()->json(['lga'=>$lga]);
    }
    else return 'Not valid id.';
  }

  public function wardRequest(Request $request)
  {
    //if required fields are received, and not empty
    if($request->has(['id']) && $request->id!=null){
        $ward = Ward::where('lga_id', $request->id)->get();
      return response()->json(['ward'=>$ward]);
    }
    else return 'Not valid id.';
  }

  public function pollingUnitRequest(Request $request)
  {
    //if required fields are received, and not empty
    if($request->has(['id']) && $request->id!=null){
        $id_array = explode(",",$request->id);
        $ward_id = $id_array[0];
        $lga_id = $id_array[1];
        $pu = PollingUnit::where('ward_id', $ward_id)->where('lga_id', $lga_id)->get();
      return response()->json(['pu'=>$pu]);
    }
    else return 'Not valid id.';
  }
}
