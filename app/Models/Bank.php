<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Bank extends Model
{
	protected $table = 'data_bank';

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable = [
		'nama_bank',
		'cabang_bank',
		'no_rekening',
		'nama_pemilik',
		'mata_uang',
		'id_data_akun'
	];

	public function akun()
	{
		return $this->belongsTo('App\Akun');
	}
}