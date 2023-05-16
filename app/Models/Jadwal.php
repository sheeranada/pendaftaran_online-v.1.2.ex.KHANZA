<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jadwal';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'kd_dokter';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli');
    }
}