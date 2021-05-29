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
        $inputs  = collect(DB::select("SELECT COUNT(*) as count FROM RF_LOG2 LEFT JOIN SNAPSHOTS ON RF_LOG2.BINLABEL = SNAPSHOTS.EMP WHERE SNAPSHOTS.ZONE <> 'D' AND RF_LOG2.ACTION = 'MOVE-IN' AND RF_LOG2.REFERENCE3 LIKE '%2Step%DirectMove%' AND DATEPART(month, DATE_TIME) = ? AND DATEPART(year, DATE_TIME) = ? AND RF_LOG2.CLIENTNAME = ?", [
            $month, $year, $client->CLIENTNAME,
        ]))->first();
        $outputs = collect(DB::select("SELECT COUNT(*) as count FROM SHIPHIST LEFT JOIN SNAPSHOTS ON SHIPHIST.BINLABEL = SNAPSHOTS.EMP WHERE DATEPART(month, SHIPHIST.DATE_UPLD) = ? AND DATEPART(year, SHIPHIST.DATE_UPLD) = ? AND SNAPSHOTS.CLIENTNAME = ?", [
            $month, $year, $client->CLIENTNAME,
        ]))->first();
        $facturations = collect(DB::select("SELECT ROWID, SELL_PRICE, DESCRIPT FROM PRODMSTR WHERE ITEMTYPE = 'FIN-G' AND CLIENTNAME = ?", [
            $client->CLIENTNAME,
        ]));
        return view('invoices.show', compact('clientInvoices', 'client', 'month', 'year', 'inputs', 'outputs', 'facturations'));
    }
}
