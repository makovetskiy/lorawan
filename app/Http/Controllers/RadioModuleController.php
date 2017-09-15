<?php

namespace App\Http\Controllers;

use finfo;
use DB;
use App\Radiomodule;
use App\Radiomoduletype;
use Illuminate\Http\Request;

class RadioModuleController extends Controller
{
    public function getAllRadiomodules(){
    	/*
        $radiomodules = DB::select('
            select "USK_ID", "USK_NAME", 
            "USKT_NAME", "AB_NAME", "RM_DEVEUI",
            "RM_APPEUI", "RM_APPKEY", "RM_DEVADDR", "RM_NWKSKEY", "RM_APPSKEY", "ADR_STR" 
            from "USK" 
            left join "ABONENT" on "ABONENT"."AB_ID" = "USK"."USK_AB_ID" 
            left join "USK_TYPE" on "USK"."USK_TYPE" = "USK_TYPE"."USKT_ID" 
            left join "Application" on "USK"."RM_APPEUI" = "Application"."AppEUI" 
            left join WP_GET_ADRESS("ABONENT"."AB_ADR_ID",1) on 1 = 1;
        ');
        */
        
        $radiomodules = Radiomodule::leftJoin('ABONENT','ABONENT.AB_ID','=','USK.USK_AB_ID')
        ->leftJoin('USK_TYPE','USK.USK_TYPE','=','USK_TYPE.USKT_ID')
        ->leftJoin('Application','USK.RM_APPEUI','=','Application.AppEUI')
        ->leftJoin("ADRESS",'ABONENT.AB_ADR_ID','=','ADRESS.ADR_ID')
        ->leftJoin('HOME', 'HOME.HOME_ID', '=', 'ADRESS.ADR_HOME_ID')
        ->leftJoin('HOME_TYPE', 'HOME_TYPE.HOMET_ID', '=', 'HOME.HOME_TYPE')
        ->leftJoin('STREET', 'STREET.STRT_ID', '=', 'HOME.HOME_STRT_ID')
        ->leftJoin('STREET_TYPE', 'STREET_TYPE.STREETT_ID', '=', 'STREET.STRT_TYPE')
        ->leftJoin('CITY', 'CITY.CITY_ID', '=', 'STREET.STRT_CITY_ID')
        ->leftJoin('CITY_TYPE', 'CITY_TYPE.CITYT_ID', '=', 'CITY.CITY_TYPE')
        ->leftJoin('REGION', 'REGION.RGN_ID', '=', 'CITY.CITY_RGN_ID')
        ->leftJoin('REGION_TYPE', 'REGION_TYPE.RGNT_ID', '=', 'REGION.RGN_TYPE')
        ->leftJoin('FLAT', 'FLAT.FLT_ID', '=', 'ADRESS.ADR_FLT_ID')
        ->get();
    	return response()->json($radiomodules,200);
    }

    public function getAllRadiomodulesTypes(){
    	$rtype = Radiomoduletype::all();
    	return response()->json($rtype,200);
    }

    public function showRadiomoduleTypeById($id){
    	$uskt = Radiomoduletype::find(1);

        return response()->json($uskt,200);
    }

    public function saveRadiomoduleType(){
        try{

            $USKT_ID    = 0;
            $USKT_NAME  = '';
            $USKT_SNAME = '';
            $edit       = 1;

            if(isset(request()->edit)){
                $edit = request()->edit;
            }


            if($edit!=0 && (!isset(request()->USKT_ID) || empty(request()->USKT_ID))){
                return response()->json("Ошибка! Пустой id ",400,[], JSON_UNESCAPED_UNICODE);
            }

            if(!isset(request()->USKT_NAME) || empty(request()->USKT_NAME)){
                return response()->json("Ошибка! Пустой USKT_NAME ",400,[], JSON_UNESCAPED_UNICODE);
            }

            if(isset(request()->USKT_SNAME) && !empty(request()->USKT_SNAME)){
                $USKT_SNAME = request()->USKT_SNAME;
            }

            $USKT_ID   = request()->USKT_ID;
            $USKT_NAME = request()->USKT_NAME;

            $uskt_n = Radiomoduletype::where("USKT_NAME",'=',$USKT_NAME)->first();

            if($uskt_n && $uskt_n->USKT_ID!=$USKT_ID){
                return response()->json("Ошибка! Радиомодуль с таким названием уже существует ",400,[], JSON_UNESCAPED_UNICODE);
            }

            if($uskt_n && $edit == 0){
                return response()->json("Ошибка! Радиомодуль с таким названием уже существует ",400,[], JSON_UNESCAPED_UNICODE);
            }

            if($edit == 0){
                $_rtypeId= Radiomoduletype::all()->max('USKT_ID');
                if($_rtypeId && $_rtypeId>0){
                    $USKT_ID = $_rtypeId;
                }

                $rtype = new Radiomoduletype;
                $rtype->USKT_ID    = $USKT_ID+1;
                $rtype->USKT_NAME  = $USKT_NAME;
                $rtype->USKT_SNAME = $USKT_SNAME;
                $rtype->save();
                return response()->json("Радиомодуль $USKT_NAME, успешно добавлен.",200,[], JSON_UNESCAPED_UNICODE);
            }

            

            $uskt = Radiomoduletype::where("USKT_ID",'=',$USKT_ID)->first();

            if(!$uskt){
                return response()->json("Ошибка! ",400,[], JSON_UNESCAPED_UNICODE);
            }

            $uskt->USKT_NAME  = $USKT_NAME;
            $uskt->USKT_SNAME = $USKT_SNAME;
            $uskt->save();
            return response()->json("Радиомодуль $USKT_NAME, успешно сохранен.",200,[], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e) {
            return response()->json("Ошибка! ".$e->getMessage(),400,[], JSON_UNESCAPED_UNICODE);
        }
    }

    public function deleteRadiomoduleType(){
        try{

            $USKT_ID = null;

            if(!isset(request()->USKT_ID) || empty(request()->USKT_ID)){
                return response()->json("Ошибка! Пустой id ",400,[], JSON_UNESCAPED_UNICODE);
            }

            $USKT_ID = request()->USKT_ID;

            if(!$USKT_ID){
                return response()->json("Ошибка! Пустой id ",400,[], JSON_UNESCAPED_UNICODE);
            }

            
            $uskt = Radiomoduletype::where("USKT_ID",'=',$USKT_ID)->delete();

            return response()->json("Запись успешно удалена!",202,[], JSON_UNESCAPED_UNICODE);

        }catch (Exception $e) {
            return response()->json("Ошибка! ".$e->getMessage(),400,[], JSON_UNESCAPED_UNICODE);
        }
    }
    
}
