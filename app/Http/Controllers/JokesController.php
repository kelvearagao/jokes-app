<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Joke;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JokesController extends Controller
{
	public function index(){
	    $jokes = Joke::all(); //Not a good idea
	    

	    return response()->json([
		         'data' => $this->transformCollection($jokes)
		    ], 200);
	}

	public function show($id){
        $joke = Joke::find($id);
 
        if(!$joke){
            return response()->json([
	                'error' => [
	                    'message' => 'Joke does not exist'
	                ]
	            ], 404);
        }
 
        return response()->json([
                'data' => $this->transform($joke)
        ], 200);
	}

	private function transformCollection($jokes){
	    return array_map([$this, 'transform'], $jokes->toArray());
	}
	 
	private function transform($joke){
	    return [
	           'joke_id' => $joke['id'],
	           'joke' => $joke['body']
	        ];
	}

}
