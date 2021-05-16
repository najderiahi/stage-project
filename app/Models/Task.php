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
        $results = DB::select("
            SELECT BINLOCAT.BINLABEL as EMP, BINLOCAT.EXTENDED, BINLOCAT.WAREHOUSE, PRODMSTR.CLIENTNAME, BINMSTR.COMMENT_IN as DESIGNATION, BINMSTR.ZONE, PRODMSTR.SELL_PRICE, BINMSTR.DATECREATE
            FROM BINMSTR INNER JOIN BINLOCAT ON BINMSTR.BINLABEL = BINLOCAT.BINLABEL INNER JOIN PRODMSTR ON PRODMSTR.EXTENDED = BINLOCAT.EXTENDED
            WHERE PRODMSTR.CLIENTNAME = :client AND DATEPART(week, BINMSTR.DATECREATE) = DATEPART(week, CURRENT_TIMESTAMP)
        ", [
            'client' => $this->CLIENTNAME,
        ]);
        $results = collect($results);
        $results = collect($results->map(fn ($item) => array_merge(get_object_vars($item), ["ID" => (string) Str::uuid()]))->toArray());
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
