<?php 

namespace App\Repositories\Register;

interface RegisterRepositoryInterface {
	
	public function createDataAkun($request, $filename);

	public function createDataBank($request, $dataAkun);

	public function createDataLainnya($request, $dataAkun);
}