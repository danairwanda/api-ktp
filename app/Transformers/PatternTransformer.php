<?php

namespace App\Transformers;

use App\Models\Temporary;
use Dingo\Api\Exception\ValidationHttpException;
use App\Repositories\Register\TemporaryRepositoryInterface;

class PatternTransformer 
{	
	public function transform(
		$data, 
		$identity, 
		$filename,
		$text_name,
		$ip
	)
	{
		$pattern = [
			'provinsi'		=>	$data[0][1] . ' ' .$data[0][2],
			'kota'			=>  $data[1][0] . ' ' .$data[1][1],
			'nik'			=>  $data[2][0] . '' .$data[2][1],
		];

		$validator 	= \Validator::make($pattern, [
			'provinsi'	=> 'required|string',
			'kota'		=> 'required|string',
			'nik'		=> 'required',
		]); 

		if ($validator->fails()) {
			$temp = new Temporary();
			$temp->image 		= $filename;
			$temp->file  		= $text_name;
			$temp->request_failed	= 1;
			$temp->ip_address 	= $ip;
			$temp->save();
			throw new ValidationHttpException(
                $validator->errors()
            );
		}

		return $pattern;
	}
}