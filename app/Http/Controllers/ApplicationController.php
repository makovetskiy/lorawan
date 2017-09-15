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

    public function createNewApplication(Request $request){
        $app =Application::where('AppEUI', request()->AppEUI)->first();
        if($app){
            $app->AppEUI = request()->AppEUI;
            $app->Name = request()->Name;
            $app->save();
            return response()->json($app,200);
        }
        else{
            $app = new Application;
            $app->AppEUI = request()->AppEUI;
            $app->Name = request()->Name;
            $app->save();
            return response()->json($app,200);
        }
    }

    public function deleteApplication(){
        $deletedRows = Application::where('AppEUI', request()->AppEUI)->delete();
        return response()->json($deletedRows,200);
    }
}
