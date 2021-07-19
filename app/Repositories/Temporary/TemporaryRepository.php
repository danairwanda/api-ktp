<?php 

namespace App\Repositories\Temporary;

use App\Models\Temporary;
use App\Repositories\Temporary\TemporaryRepositoryInterface;

class TemporaryRepository implements TemporaryRepositoryInterface
{
	public function tempRequestSuccess($filename, $text_name, $ip)
	{
		// simpan data temporary 
		$temp = new Temporary();
		$temp->image 		= $filename;
		$temp->file  		= $text_name;
		$temp->request_success	= 1;
		$temp->ip_address 	= $ip;
		$temp->save();
	}

	public function tempRequestFailed($url, $ip)
	{
		// simpan data temporary 
		$temp = new Temporary();
		$temp->image 			= $url;
		$temp->request_failed	= 1;
		$temp->ip_address 		= $ip;
		$temp->save();
	}
}