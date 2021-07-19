<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class APIkey
{ 
    public function handle($request, Closure $next)
    { 

       if ($request['api_key'] == '') {

			   return response("Whoops, you haven't access this API", 401);            
        
        }else{ 

            $users = User::where('api_key', $request['api_key'])->count();
            
            if ($users != 1) { 

              return response("Invalid access key", 401);
            
            } else { 
            
              return $next($request);
            
            }
        } 
   }
}