<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Snapshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientInvoiceController extends Controller
{
    public function show(Customer $client) {
        $clientProducts = Snapshot::where('CLIENTNAME', $client->CUST_NAME)->paginate();
        return view('invoices.show', compact('clientProducts', 'client'));
    }
}
