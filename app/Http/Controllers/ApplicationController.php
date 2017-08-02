<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function getAllApication(){
        $app = Application::all();
        return response()->json($app,200);
    }

    public function createNewApplication(){
        $app = Application::create([
          'AppEUI' => 'qwert',
          'Name' => request()->Name,
          'Code' => null
        ]);

        return response()->json($app,200);
    }
}
