<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Snapshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientInvoiceController extends Controller
{
    public function create(Customer $client) {
        $clientProducts = Snapshot::where('CLIENTNAME', $client->CUSTNAME)->paginate();
        return view('invoices.show', compact('clientProducts'));
    }
}
