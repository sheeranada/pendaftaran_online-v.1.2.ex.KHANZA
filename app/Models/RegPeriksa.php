<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegPeriksa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reg_periksa';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_reg',
        'no_rawat',
        'tgl_registrasi',
        'jam_reg',
        'kd_dokter',
        'no_rkm_medis',
        'kd_poli',
        'p_jawab',
        'almt_pj',
        'hubunganpj',
        'biaya_reg',
        'stts',
        'stts_daftar',
        'status_lanjut',
        'kd_pj',
        'umurdaftar',
        'sttsumur',
        'status_bayar',
        'status_poli',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $primaryKey = 'no_rawat';
    public $timestamps = false;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter');
    }
}