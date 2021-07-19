<?php

namespace App\Http\Vision;

use App\Models\Temporary;
use Google\Cloud\Vision\VisionClient;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use App\Transformers\PatternTransformer;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Register\TemporaryRepositoryInterface;

class LaravelGCV {

	public function colors($file) {

		//EXT PATH
		if (is_string($file) && in_array(parse_url($file, PHP_URL_SCHEME), array('http', 'https'))) {
			$imageData = @file_get_contents($file);
			if ($imageData === FALSE) {
				return null;
			}
		} else {
			$imageData = $file;
		}

		$config = [
			'keyFilePath' => config('gcv.key_file_path'),
			'projectId' => config('gcv.project_id'),
		];

		$vision = new VisionClient($config);
		$image = $vision->image($imageData, [
			'IMAGE_PROPERTIES',
		]);

		$result = $vision->annotate($image);

		if (is_null($result->imageProperties())) {
			return null;
		}

		$colors = $result->imageProperties()->colors();

		return $colors;
    }
    
    public function detect_text($file)
    {

    	//EXT PATH
		if (is_string($file) && in_array(parse_url($file, PHP_URL_SCHEME), array('http', 'https'))) {
			$imageData = @file_get_contents($file);
			if ($imageData === FALSE) {
				return null;
			}
		} else {
			$imageData = $file;
		}

        $config = [
            'keyFilePath'   =>  config('gcv.key_file_path'),
            'projectId'     =>  config('gcv.project_id'),
        ];

        $vision = new VisionClient($config);
        $image  = $vision->image($imageData, [
            'TEXT_DETECTION'
        ]);

        $result = $vision->annotate($image);

		$text       = $result->text();
		$variable   = explode("\n", strtoupper($text[0]->description()));		
		\Storage:: disk('s3')->put('array-ktp' . time() . '.txt', $text[0]->description());
			
		$data = [];
		foreach ($variable as $key => $value) {
			$array = $value . ' ';
			$ktp = preg_replace('~/GOL. DARAH|NIK|NAMA|KEWARGANEGARAAN|NAMA|STATUS PERKAWINAN|BERLAKU HINGGA|ALAMAT|AGAMA|TEMPAT/TGL LAHIR|JENIS KELAMIN|GOL DARAH|RT/RW|DESA|KECAMATAN/~',' ',$array);
			$string 		= str_replace(':','', $ktp);
			
			if ($string !== "  ") {
				$data[] = explode(' ', $string);
			}
		}

		$pattern = new PatternTransformer();

		$format  = $pattern->transform($data);

		return $format;
    }

    public function detect_text_description($path, $filename, $ip)
    {
    	$identity = str_replace(array('_','image','.png'), '', $filename); 

        $config = [
            'keyFilePath'   =>  config('gcv.key_file_path'),
            'projectId'     =>  config('gcv.project_id'),
        ];

		$vision     = new VisionClient($config);
        $image      = $vision->image(file_get_contents($path), ['TEXT_DETECTION']);
        $result     = $vision->annotate($image);
        $text       = $result->text();
        $variable   = explode("\n", strtolower($text[0]->description()));

        // store text extraction
        $text_name   = 'array-ktp' . time() . '.txt';
        $path		= "Teks/".$text_name;
        // local
        // $text_file	= \Storage::put($text_name, $text[0]->description());
        // aws
        $text_file	= \Storage::disk('s3')->put($path, $text[0]->description());         

		$data = [];
		foreach ($variable as $key => $value) {
			$array = $value . ' ';
			$ktp = preg_replace('~/gol. darah|nik|nama|kewarganegaraan|nama|status|perkawinan|berlaku hingga|alamat|agama|tempat/tgl lahir|jenis kelamin|gol darah|rt/rw|desa|kecamatan/~',' ',$array);
			$string 		= str_replace(':','', $ktp);
			if ($string !== "  ") {
				$data[] = explode(' ', $string);
			}
		}

		$pattern = new PatternTransformer();
		$format  = $pattern->transform(
			$data, 
			$identity, 
			$filename,
			$text_name,
			$ip
		);

		$temp = new Temporary();
		$temp->image 			= $filename;
		$temp->file  			= $text_name;
		$temp->request_success	= 1;
		$temp->ip_address 		= $ip;
		$temp->save();

		return $format;
    }
}