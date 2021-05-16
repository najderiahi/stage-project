<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Snapshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientInvoiceController extends Controller
{
    public function show(Customer $client) {
        $clientInvoices = DB::table('SNAPSHOTS')->select('DESIGNATION', 'COUNT(EMP) as NBR_EMP', 'DATEPART(week, DATECREATE)')
            ->where('CLIENTNAME', $client->CLIENTAME)
            ->groupBy('DESIGNATION', 'DATECREATE')
            ->get();
        $clientInvoices = $clientInvoices->groupBy('DESINGATION');
        return view('invoices.show', compact('clientInvoices', 'client'));
    }
}
