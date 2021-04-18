<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = "ROWID";
    protected $table = "CUSTMSTR";
    protected $keyType = 'string';
    public $incrementing = false;

    public function scopePlCustomers($query) {
        return $query->where("CUSTGROUP", "3PL");
    }
}
