<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "PRODMSTR";
    protected $primaryKey = "ROWID";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}
