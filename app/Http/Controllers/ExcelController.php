<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
class ExcelController extends Controller
{
    public function store(Request $req){
        $json = json_encode($req->data_arr);
        $bytes = file_put_contents("excel.json", $json); 
        return $bytes;
    }
    public function download(Request $req){
        $data = file_get_contents("excel.json");
        $json = json_decode($data);
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new ExcelExport($json),'orders.xlsx');
    }
}
