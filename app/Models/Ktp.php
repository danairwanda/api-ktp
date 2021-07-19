<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Ktp extends Model
{
	protected $table 	= 'data_ktp';

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable = [
		'nik',
		'provinsi',
		'kota',
		'nama',
		'tempat_lahir',
		'tanggal_lahir'
	];
}
