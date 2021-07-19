<?php 

namespace App\Repositories\Register;

use App\Models\Akun;
use App\Models\Bank;
use App\Models\Lainnya;
use App\Repositories\Register\RegisterRepositoryInterface;

/**
 * 
 */
class RegisterRepository implements RegisterRepositoryInterface
{
	public function createDataAkun($request, $file)
	{
		$dataAkun = Akun::create([
			'nik'			=>	$request['nik'],
			'nama'			=>	$request['nama'],
			'email'			=>	$request['email'],
			'phone'			=>	$request['phone'],
			'tanggal_lahir'	=>	$request['tanggal_lahir'],
			'ktp'			=>	$file,
			'kode_referal'	=>	$request['kode_referal']
		]);

		return $dataAkun;
	}

	public function createDataBank($request, $dataAkun)
	{
		$dataBank = Bank::create([
			'nama_bank'		=>	$request['nama_bank'],
			'cabang_bank'	=>	$request['cabang_bank'],
			'no_rekening'	=>	$request['no_rekening'],
			'nama_pemilik'	=>	$request['nama_pemilik'],
			'mata_uang'		=>	$request['mata_uang'],
			'id_data_akun'	=>	$dataAkun->id
		]);

		return $dataBank;
	}

	public function createDataLainnya($request, $dataAkun)
	{
		$dataLainnya = Lainnya::create([
			'pendidikan'		=>	$request['pendidikan'],
			'penghasilan'		=>	$request['penghasilan'],
			'sumber_penghasilan'=>	$request['sumber_penghasilan'],
			'tujuan_investasi'	=>	$request['tujuan_investasi'],
			'green_card'		=>	$request['green_card'],
			'profil_resiko'		=>	$request['profil_resiko'],
			'id_data_akun'		=>	$dataAkun->id
		]);

		return $dataLainnya;
	}
}