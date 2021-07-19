<?php 

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageUpload 
{
	/**
	 * File upload trait used in controllers to upload files in Local
	 */
	public function storeLocal($file)
	{
        $fileIdentity   = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
        $filename       = '_image'. time(). '.png';
        $moveLocal      = \Storage::put($filename, $fileIdentity);

        return $filename;
	}

	/**
	 * File upload trait used in controllers to upload files in AWS Amazon
	 */
	public function storeCloud($file)
	{
		
        $fileIdentity   = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
        $filename       = '_image'. time(). '.png';
        $path			= "KTP/".$filename;
        $aws_file       = \Storage::disk('s3')->put($path, $fileIdentity);
        $url            = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $filename;

        return $filename;
	}
}