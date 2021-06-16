<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Snapshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientInvoiceController extends Controller
{
    public function show(Customer $client) {
        $month = request()->has('month') ? request()->get('month') : now()->month;
        $year = request()->has('year') ? request()->get('year') : now()->year;
        $clientInvoices = collect(DB::select("SELECT DESIGNATION, COUNT(EMP) AS NBR_EMP, SEMAINE FROM (SELECT DESIGNATION, EMP, CLIENTNAME, ((DATEPART(WEEK, DATECREATE) - DATEPART(WEEK, DATEADD(day, 1, EOMONTH(DATECREATE, -1)))) + 1) AS SEMAINE FROM SNAPSHOTS WHERE DATEPART(month, DATECREATE) = ? AND DATEPART(year, DATECREATE) = ?) DUMMYTABLE WHERE CLIENTNAME = ? GROUP BY DESIGNATION, SEMAINE", [
            $month, $year, $client->CLIENTNAME,
            ]),
        )->groupBy('DESIGNATION');
        $inputs  = collect(DB::select("SELECT COUNT(*) as count FROM RF_LOG2 LEFT JOIN SNAPSHOTS ON RF_LOG2.BINLABEL = SNAPSHOTS.EMP WHERE SNAPSHOTS.ZONE <> 'D' AND RF_LOG2.ACTION = 'MOVE-IN' AND RF_LOG2.REFERENCE3 LIKE '%2Step%DirectMove%' AND DATEPART(month, DATE_TIME) = ? AND DATEPART(year, DATE_TIME) = ? AND RF_LOG2.CLIENTNAME = ?", [
            $month, $year, $client->CLIENTNAME,
            ]),
        )->first();
        $outputs = collect(DB::select("SELECT COUNT(*) as count FROM SHIPHIST LEFT JOIN SNAPSHOTS ON SHIPHIST.BINLABEL = SNAPSHOTS.EMP WHERE DATEPART(month, SHIPHIST.DATE_UPLD) = ? AND DATEPART(year, SHIPHIST.DATE_UPLD) = ? AND SNAPSHOTS.CLIENTNAME = ?", [
            $month, $year, $client->CLIENTNAME,
            ]),
        )->first();
        $facturations = collect(DB::select("SELECT ROWID, SELL_PRICE, DESCRIPT FROM PRODMSTR WHERE ITEMTYPE = 'FIN-G' AND CLIENTNAME = ?", [
            $client->CLIENTNAME,
            ]),
        );
        return view('invoices.show', compact('clientInvoices', 'client', 'month', 'year', 'inputs', 'outputs', 'facturations'));
    }

    public function store(Request $request, Customer $client) {
        $request->validate([
            'total_prices_designation' => 'required|array',
            'total_prices_designation.*' => 'numeric|min:0',
            'designations' => 'required|array',
            'designations.*' => 'string|nullable',
            'inputs_price' => 'required|numeric|min:0',
            'outputs_price' => 'required|numeric|min:0',
        ]);

        $designations = $request->designations;
        $total_prices_designation = $request->total_prices_designation;
        $products = collect($designations)->zip(collect($total_prices_designation))
            ->map(function ($item) use ($client) {
                $prodName ='FIN' . Str::random(6);
                $item[] = $prodName;
                $item[] = 'FIN';
                $item[] = "$client->CLIENTNAME - Emplacement $item[0]";
                $item[] = Str::uuid();
                $item[] = "$prodName / $client->CLIENTNAME";
                $item[] = now();
                return $item;
            });
        $products = $products->map(fn($item) => collect(['DESIGNATION', 'SELL_PRICE', 'PRODUCT', 'ITEMTYPE', 'DESCRIPT', 'ROWID', 'EXTENDED', 'DATECREATE'])->combine($item));
        $products->each(fn($item) => $item->forget('DESIGNATION'));
        $products->each(fn ($item) => Product::create($item->toArray()));
        $name ='FIN' . Str::random(6);
        Product::create([
            'PRODUCT' => $name,
            'SELL_PRICE' => $request->inputs_price,
            'ITEMTYPE' => 'FIN',
            'ROWID' => Str::uuid(),
            'DESCRIPT' => "$client->CLIENTNAME - ENTREES",
            'EXTENDED' => "$name / $client->CLIENTNAME",
            'DATECREATE' => now(),
        ]);
        $name ='FIN' . Str::random(6);
        Product::create([
            'PRODUCT' => $name,
            'SELL_PRICE' => $request->outputs_price,
            'ITEMTYPE' => 'FIN',
            'ROWID' => Str::uuid(),
            'DESCRIPT' => "$client->CLIENTNAME - SORTIES",
            'EXTENDED' => "$name / $client->CLIENTNAME",
            'DATECREATE' => now(),
        ]);
        return redirect()->route('clients.index');
    }
}
