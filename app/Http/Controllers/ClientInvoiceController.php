<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Snapshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientInvoiceController extends Controller
{
    public function show(Customer $client) {
        $month = request()->has('month') ? request()->get('month') : now()->month;
        $year = request()->has('year') ? request()->get('year') : now()->year;
        $clientInvoices = collect(DB::select("SELECT DESIGNATION, COUNT(EMP) AS NBR_EMP, SEMAINE FROM (SELECT DESIGNATION, EMP, CLIENTNAME, ((DATEPART(WEEK, DATECREATE) - DATEPART(WEEK, DATEADD(day, 1, EOMONTH(DATECREATE, -1)))) + 1) AS SEMAINE FROM SNAPSHOTS WHERE DATEPART(month, DATECREATE) = ? AND DATEPART(year, DATECREATE) = ?) DUMMYTABLE WHERE CLIENTNAME = ? GROUP BY DESIGNATION, SEMAINE", [
            $month, $year, $client->CLIENTNAME,
        ]))->groupBy('DESIGNATION');
        return view('invoices.show', compact('clientInvoices', 'client', 'month', 'year'));
    }
}
