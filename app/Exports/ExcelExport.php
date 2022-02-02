<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;
class ExcelExport implements FromCollection
{
    protected $data_arr;
    /** 
     * @return \Illuminate\Support\Collection 
     **/
    function __construct ($data_arr){
        $this->data_arr = $data_arr;
    }
    public function collection()
    {
         return collect($this->data_arr);
    }
}
