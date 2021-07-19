<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 */
class Temporary extends Model
{
	use SoftDeletes;

    protected $table = 'data_temporary';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable	= [
		'image',
		'file',
		'request_success',
		'request_failed',
		'ip_address',
	];
}