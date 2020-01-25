<?php

namespace App\Exports;
use App\POS;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
class POSExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements  FromArray, WithHeadings,ShouldAutoSize,WithCustomValueBinder
{
    public $serial_number;
    public $agent_name;
    public $kem_id;
    public $device_type;
    public $delivery_time;
    public function __construct(array $query_key)
    {
        $this->serial_number = $query_key['serial_number'];
        $this->agent_name = $query_key['agent_name'];
        $this->kem_id = $query_key['kem_id'];
        $this->device_type = $query_key['device_type'];
        $this->delivery_time = $query_key['delivery_time'];

    }
    public function headings(): array
    {
        return [
            
            '发货时间',
            '灌装时间',
            '商户名称',
            'K米商户号',
            '通联商户号',
            '终端号',
            '设备序列号',
            '代理商',
        ];
    }
    
    public function array(): array
    { 
        $serial_number= $this->serial_number;
        $agent_name= $this->agent_name;
        $kem_id= $this->kem_id;
        $device_type= $this->device_type;
        $delivery_time= $this->delivery_time;
        return POS::when($serial_number, function ($query) use ($serial_number) {
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
            ->get(['delivery_time', 'config_time','company_name','kme_id','william_id','terminal_number','serial_number','agent_name'])->toArray();
    }
}
