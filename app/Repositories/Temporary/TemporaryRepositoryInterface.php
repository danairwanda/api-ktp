<?php 

namespace App\Repositories\Temporary;

interface TemporaryRepositoryInterface {
	
	public function tempRequestSuccess($filename, $text_name, $ip);

	public function tempRequestFailed($url, $ip);
}