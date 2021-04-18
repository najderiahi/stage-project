<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::plCustomers()->paginate();
        return view("clients.index", compact("customers"));
    }

    public function show(Customer $client) {
        return view("clients.show", compact("client"));
    }
}
