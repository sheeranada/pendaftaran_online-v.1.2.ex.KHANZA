<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poliklinik';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $keyType = 'string';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'kd_poli';

    public function bookingPeriksa()
    {
        return $this->hasMany(BookingPeriksa::class);
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}