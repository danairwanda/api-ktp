<?php 

namespace App\Repositories\Identitas;

use App\Models\Ktp;
use App\Repositories\Identitas\IdentitasRepositoryInterface;

class IdentitasRepository implements IdentitasRepositoryInterface
{
	public function create($params)
	{
		// simpan data temporary 
		$ktp = new Ktp();
		$ktp->nik 		= $params['nik'];
		$ktp->provinsi  = $params['provinsi'];
		$ktp->kota		= $params['kota'];
		$ktp->save();
	}
}