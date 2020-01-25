<?php

namespace App\Http\Controllers;

use App\Imports\POS_delivery_Import;
use App\Imports\POS_config_Import;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\POSExport;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    
  public function import_delivery()
   {

    $bRes=Excel::import(new POS_delivery_Import,request()->file('excelfile'));
    if ($bRes === false) {
        $arrResult = [
            "errno" => 1,
            "error" => "POS_delivery_Import fail",
            "result" => ""
        ];
    }
    $arrResult = [
        "errno" => 0,
        "error" => "",
        "result" => ""
    ];
       return back()->with('操作结果',$arrResult);

   }
   public function import_config()
    {
        $bRes=Excel::import(new POS_config_Import,request()->file('excelfile'));
        if ($bRes === false) {
            $arrResult = [
                "errno" => 1,
                "error" => "POS_config_Import fail",
                "result" => ""
            ];
        }
        $arrResult = [
            "errno" => 0,
            "error" => "",
            "result" => ""
        ];
        return back()->with('操作结果',$arrResult);

    }
    public function DownloadFile () {
        $file = storage_path('app/public/pos'.'.xlsx');
        ob_end_clean();
        return response()->download($file);
    }

    public function export(Request $request) 
    { 
        $query_key=$request->all();
        ob_end_clean();
        $status=Excel::store(new POSExport($query_key), 'pos.xlsx', 'public');
        if($status==false){
            $res['status']='error Excel store error';
        }
        $res['status']='sucess';
        $res['data'] = route('download');
        return $res;
        
    }

}
