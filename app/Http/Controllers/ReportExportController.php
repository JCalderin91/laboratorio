<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ApiController;

class ReportExportController extends ApiController
{
    
    public function reportExport(Request $request){

        $orders = $this->queryReport($request);

        return (new ReportExport($orders))->download('report.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }
}
