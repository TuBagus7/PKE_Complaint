<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model
{
    use softDeletes;
    protected $fillable = [
        'name',
        'image',
    ];

    public function reports()
    {
        // satu kategori memiliki banyak laporan
        return $this->hasMany(Report::class);
    }
}
