<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'resident_id',
        'report_category_id',
        'title',
        'description',
        'image',
        'latitiude',
        'longitude',
        'address',
    ];

    public function residetn()
    {
        //satu laporan dimilki oleh satu resident / warga
        return $this->belongsTo(Resident::class);
    }
    public function category()
    {
        return $this->belongsTo(ReportCategory::class);
    }

    public function status()
    {
        // satu laporan memiliki banyak status
        return $this->hasMany(ReportStatus::class);
    }
}
