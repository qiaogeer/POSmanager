<?php

namespace App\Imports;

use App\POS;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
class POS_config_Import implements ToModel
{
    /**
    * @param array $rowx
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0]=='灌装时间') {
       return null;
        }
      $config_time=(int)$row[0]-2;
       $row[0] = Carbon::parse('1900-01-01')->addDays($config_time);
        return  POS::updateOrCreate([
          'serial_number'=>$row[5],
        ],
          ['config_time'=>$row[0],
            'company_name'=>$row[1],
            'william_id'=>$row[2],
             'terminal_number'=>$row[3],
            'serial_number'=>$row[5],
            'device_type'=>is_numeric($row[3])?2:1,
        ]
        );

      }



}
