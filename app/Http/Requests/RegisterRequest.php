<?php 
	
namespace App\Http\Requests;

use Illuminate\Http\Request;
/**
 * 
 */
class RegisterRequest extends Request
{
	public function rules()
	{
		return [
			'nik'					=>	'required',
			'nama'					=> 	'required',
			'email'					=>	'required|email',
			'phone'					=>	'required',
			'tanggal_lahir'			=>	'required',
			'ktp'					=>	'required',
			'nama_bank'				=>	'required',
			'cabang_bank'			=>	'required',
			'no_rekening'			=>	'required',
			'nama_pemilik'			=>	'required',
			'mata_uang'				=>	'required',
			'pendidikan'			=>	'required',
			'penghasilan'			=>	'required',
			'sumber_penghasilan'	=>	'required',
			'tujuan_investasi'		=>	'required',
			'profil_resiko'		=>	'required|integer'
		];
	}
}
