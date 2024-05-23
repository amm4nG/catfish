<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsValue extends Model
{
    use HasFactory;
    protected $table = 'isvalue';
    // Set primary key menjadi null
    protected $primaryKey = null;

    // Nonaktifkan incrementing
    public $incrementing = false;

    // Set timestamps ke false jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;
}
