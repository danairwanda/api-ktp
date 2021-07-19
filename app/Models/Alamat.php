<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Alamat extends Model
{
	protected $table 	= 'data_alamat';

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable = [
		'alamat',
		'kota',
		'provinsi',
		'negara',
		'kode_pos'
	];

	public function akun()
	{
		return $this->belongsTo('App\Akun');
	}
}