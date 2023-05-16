<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Jakarta');
class BookingPeriksa extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'no_booking';

    protected $table = 'booking_periksa';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_booking',
        'tanggal',
        'nama',
        'alamat',
        'no_telp',
        'email',
        'kd_poli',
        'tambahan_pesan',
        'status',
        'tanggal_booking',
    ];
    public $timestamps = false;

    public $incrementing = false;

    public function klinik()
    {
        return $this->belongsTo(Poliklinik::class, 'kd_poli');
    }

}