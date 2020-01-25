<?php

namespace App\Imports;

use App\POS;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
class POS_delivery_Import implements ToModel
{
    /**
    * @param array $rowx
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0]=='收货单位') {
       return null;
        }

      $delivery_time=(int)$row[2]-2;
       $row[2] = Carbon::parse('1900-01-01')->addDays($delivery_time);

        return  POS::updateOrCreate([
          'serial_number'=>$row[1],
        ],
          ['receive_name'=>$row[0],
            'serial_number'=>$row[1],
             'delivery_time'=>$row[2],
            'agent_name'=>$row[3]
        ]
        );

      }



}
