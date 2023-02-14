<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitVoteRequest;
use App\Models\AgentName;
use App\Models\Lga;
use App\Models\PollingUnit;
use App\Models\PollingUnitResult;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function unitResult()
    {
        $state = State::all();
        return view('unit-result', compact('state'));
    }

    public function totalResult()
    {
        $state = State::all();
        return view('total-result', compact('state'));
    }

    public function addResult()
    {
        return view('add-result');
    }

    public function storeVote(SubmitVoteRequest $request)
    {
        $pu = PollingUnit::where('polling_unit_number', $request->polling_unit_number)->first();
        if (!empty($pu)) {
            $pu_id = $pu->uniqueid;
        }else {
            return redirect()->back()->with('error', 'Polling unit number not found');
        }

            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            }else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else if (isset($_SERVER['HTTP_X_FORWARDED'])){
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            }else if (isset($_SERVER['HTTP_FORWARDED_FOR'])){
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            }else if (isset($_SERVER['HTTP_FORWARDED'])){
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            }else if (isset($_SERVER['REMOTE_ADDR'])){
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            }else{
                $ipaddress = 'UNKNOWN';
            }


        PollingUnitResult::create([
            'polling_unit_uniqueid' => $pu_id,
            'party_abbreviation' => $request->party_abbreviation,
            'party_score' => $request->party_vote,
            'entered_by_user' => $request->admin_name,
            'date_entered' => now(),
            'user_ip_address' => $ipaddress
        ]);
        return redirect()->back()->with('success', 'Record submitted successfully');
    }

    public function lgaRequest(Request $request)
    {
        //if required fields are received, and not empty
        if ($request->has(['id']) && $request->id != null) {
            $lga = Lga::where('state_id', $request->id)->get();
            return response()->json(['lga' => $lga]);
        }else return 'Not valid id.';
    }

    public function wardRequest(Request $request)
    {
        //if required fields are received, and not empty
        if ($request->has(['id']) && $request->id != null) {
            $ward = Ward::where('lga_id', $request->id)->get();
            return response()->json(['ward' => $ward]);
        }else return 'Not valid id.';
    }

    public function pollingUnitRequest(Request $request)
    {
        //if required fields are received, and not empty
        if ($request->has(['id']) && $request->id != null) {
            $id_array = explode(",", $request->id);
            $ward_id = $id_array[0];
            $lga_id = $id_array[1];
            $pu = PollingUnit::where('ward_id', $ward_id)->where('lga_id', $lga_id)->get();
            return response()->json(['pu' => $pu]);
        }else return 'Not valid id.';
    }

    public function resultRequest(Request $request)
    {
        //if required fields are received, and not empty
        if ($request->has(['id']) && $request->id != null) {
            $result = PollingUnitResult::where('polling_unit_uniqueid', $request->id)->get();
            return response()->json(['result' => $result]);
        }else return 'Not valid id.';
    }

    public function totalRequest(Request $request)
    {
        $pu_ids = [];
        $results = [];
        //if required fields are received, and not empty
        if ($request->has(['id']) && $request->id != null) {
            $pu_data = PollingUnit::where('lga_id', $request->id)->get()->toArray();
            foreach ($pu_data as $data) {
                array_push($pu_ids, $data['uniqueid']);
            }
            foreach ($pu_ids as $data) {
                $result = PollingUnitResult::where('polling_unit_uniqueid', $data)->get();
                array_push($results, $result);
            }
            return response()->json($results);
        }else return 'Not valid id.';
    }
}
