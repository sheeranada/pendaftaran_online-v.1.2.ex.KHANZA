<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pasien';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = [];
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'no_rkm_medis';
}