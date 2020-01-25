<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\POS;


class POScontroller extends Controller
{
    public function list(Request $request)
    {
        $serial_number = $request->input('serial_number');
        $agent_name = $request->input('agent_name');
        $kem_id = $request->input('kem_id');
        $device_type = $request->input('device_type');
        $delivery_time = $request->input('delivery_time');
        $bRes = POS::when($serial_number, function ($query) use ($serial_number) {
            return $query->where('serial_number', 'like', '%' . $serial_number . '%');
        })
            ->when($agent_name, function ($query) use ($agent_name) {
                return $query->where('agent_name', 'like', '%' . $agent_name . '%');
            })
            ->when($kem_id, function ($query) use ($kem_id) {
                return $query->where('kem_id', 'like', '%' . $kem_id . '%');
            })
            ->when($device_type, function ($query) use ($device_type) {
                return $query->where('device_type', $device_type);
            })
            ->when($delivery_time, function ($query) use ($delivery_time) {
                $delivery_time = explode("-", $delivery_time);
                return $query->whereMonth('delivery_time', '=', $delivery_time[1]);
            })
            ->when($delivery_time, function ($query) use ($delivery_time) {
                $delivery_time = explode("-", $delivery_time);
                return $query->whereYear('delivery_time', '=', $delivery_time[0]);
            })
            ->get();
        if ($bRes == false) {
            $ret = [
                "errno" => 1,
                "error" => "query fail",
                "result" => ""
            ];
        }
        $pos = $bRes->toArray();

        $pageNumber = $request->offset;
        $pageSize = $request->limit;
        $data = array_slice($pos, $pageNumber, $pageSize);
        $total = count($pos);
        $ret = [
            'total' => $total,
            'data' => $data
        ];
        return json_encode($ret);
    }

    public function update(Request $request)
    {
        if (is_numeric($request->terminal_number)) {
            POS::where('id', $request->id)->update(['device_type' => 2]);
        }
        else{POS::where('id', $request->id)->update(['device_type' => 1]);}
        $bRes = POS::where('id', $request->id)->update($request->all());
        if ($bRes === false) {
            $arrResult = [
                "errno" => 1,
                "error" => "update fail",
                "result" => ""
            ];
        }
        $arrResult = [
            "errno" => 0,
            "error" => "",
            "result" => ""
        ];
        return json_encode($arrResult);
    }
    public function delete(Request $request)
    {
        $ids = explode(",", $request->ids);
        $bRes = POS::destroy($ids);
        if ($bRes === false) {
            $arrResult = [
                "errno" => 1,
                "error" => "delete fail",
                "result" => ""
            ];
        }
        $arrResult = [
            "errno" => 0,
            "error" => "",
            "result" => ""
        ];
        return json_encode($arrResult);
    }
}
