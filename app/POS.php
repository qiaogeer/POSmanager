<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POS extends Model
{
  protected $fillable =[
    'delivery_time','receive_name','serial_number','agent_name','config_time',
    'company_name','william_id','kem_id','terminal_number','device_type'
  ];
  protected $table = 'pos';
}
