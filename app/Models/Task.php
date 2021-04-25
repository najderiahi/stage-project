<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    protected $table = "TASKS";

    protected $guarded = [];

    public function execute() {
        $results = DB::table('BINLOCAT')->select('PRODMSTR.PRODUCT', 'BINLOCAT.BINLABEL', 'BINLOCAT.CLIENTNAME')
            ->join('BINMSTR', 'BINMSTR.BINLABEL', '=', 'BINLOCAT.BINLABEL')
            ->join('PRODMSTR', 'PRODMSTR.PROD_UDF2', '=', 'BINMSTR.COMMENT_IN')
            ->where('BINLOCAT.CLIENTNAME', $this->CLIENTNAME)
            ->get();
        $results = collect($results->map(fn ($item) => array_merge(get_object_vars($item), ["ROWID" => (string) Str::uuid()]))->toArray());
        $results->each(fn ($chunk) => Snapshot::insert($chunk));
    }

    public function getFrequencyAttribute() {
        if ($this->CUST_UDF2 == 'A') {
            return '0 0 1 1 *';
        } else if ($this->CUST_UDF2 == 'M') {
            return '0 0 1 * *';
        } else if ($this->CUST_UDF2 == 'H') {
            return '0 0 * * 1';
        } else {
            throw new \Exception("Invalid value");
        }
    }
}
