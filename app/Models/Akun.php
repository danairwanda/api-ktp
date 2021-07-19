<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Akun extends Model
{
	protected $table 	= 'data_akun';

	protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable = [
		'nik',
		'nama',
		'email',
		'phone',
		'status',
		'tanggal_lahir',
		'ktp',
		'kode_referal'
	];

	public function bank()
	{
		return $this->hasOne('App\Models\Bank', 'id_data_akun');
	}

	public function lainnya()
	{
		return $this->hasOne('App\Models\Lainnya', 'id_data_akun');
	}

	public function alamat()
	{
		return $this->hasOne('App\Models\Alamat', 'id_data_akun');
	}
}
