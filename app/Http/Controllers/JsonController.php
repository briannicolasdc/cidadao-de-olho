<?php

namespace App\Http\Controllers;

use App\Models\deputados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class JsonController extends Controller
{




    public function store(){
    $response = PostController::getData();
    deputados::insert($response)->withSuccess('Great! Successfully store data in json format in db');
    }

}


