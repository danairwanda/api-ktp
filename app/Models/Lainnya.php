<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Lainnya extends Model
{
	protected $table = 'data_lainnya';

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable = [
		'pendidikan',
		'penghasilan',
		'sumber_penghasilan',
		'tujuan_investasi',
		'green_card',
		'profil_resiko',
		'id_data_akun'
	];

	public function akun()
	{
		return $this->belongsTo('App\Akun');
	}
}