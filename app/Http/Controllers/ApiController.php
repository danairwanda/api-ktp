<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Ktp;
use App\Models\Temporary;
use App\Http\Vision\LaravelGCV;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Identitas\IdentitasRepositoryInterface;
use App\Repositories\Temporary\TemporaryRepositoryInterface;
use App\Repositories\Register\RegisterRepositoryInterface;
use App\Traits\ImageUpload;

class ApiController extends Controller{

    use ImageUpload;
    
    public function __construct(
        IdentitasRepositoryInterface $IdentitasRepository, 
        TemporaryRepositoryInterface $TemporaryRepository,
        RegisterRepositoryInterface $RegisterRepository
    )
    {
        $this->IdentitasRepository = $IdentitasRepository;
        $this->TemporaryRepository = $TemporaryRepository;
        $this->RegisterRepository  = $RegisterRepository;
    }

    public function colors()
    {
        $GCV = new LaravelGCV();

        $result = $GCV->colors(Storage::disk('local')->get('test-ktp12.png'));
        return response()->json(compact('result'));
    }

    public function sample_text()
    {
        try {
            $GCV    = new LaravelGCV();
            $result = $GCV->detect_text(Storage::disk('local')->get('test-ktp12.png'));
            return response()->json(compact('result'));   
        } catch (Exception $e) {
            return response()->json(array(
                'success' => false,
                'status_code' => 500,
                'errors' => 'Failed upload file from server. '.$e->getMessage(),
            ), 500);
        }
    }

    public function upload_ktp(Request $request)
    {
        // validate image
        $this->validate($request, [
            'file'  =>  'required'
        ]);

        $ip             = $request->ip();
        $file           = $request->file;
        $url            = '_image'. time(). '.png';

        try {
            $gcv    = new LaravelGCV();
            $result = $gcv->detect_text_description($file, $url, $ip);
            $this->IdentitasRepository->create($result);
            return response()->json(['data' => $result]);            
        } catch (\Exception $e) {
            $this->TemporaryRepository->tempRequestFailed($url, $ip);
            return response()->json(array(
                'success' => false,
                'status_code' => 500,
                'errors' => 'Failed upload file from server. '.$e->getMessage(),
            ), 500);

        }
    }

    public function Register(Request $request)
    {   
        $validate       = new RegisterRequest;
        $this->validate($request, $validate->rules());


        $file = $this->storeCloud($request->identity);

        DB::beginTransaction();

        try {
            // create data akun
            $dataAkun       = $this->RegisterRepository->createDataAkun($request, $file);
            // create data bank
            $dataBank       = $this->RegisterRepository->createDataBank($request, $dataAkun);
            // create data lainnya
            $dataLainnya    = $this->RegisterRepository->createDataLainnya($request, $dataAkun);
            // commit all datas
            DB::commit();

            return response()->json(array(
                'success' => true,
                'status_code' => 200,
                'messages' => 'Registration Successfully.. :) ',
            ), 200);

        } catch (\Exception $e) {
            DB::rollback();
            // something when wrong
            return response()->json(array(
                'success' => false,
                'status_code' => 500,
                'errors' => 'Failed registration file from server. '.$e->getMessage(),
            ), 500);
        }

    }
}