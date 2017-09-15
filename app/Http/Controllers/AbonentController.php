<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Abonent;
use App\Persons;
use App\AbonentType;
use App\SprutUser;
use App\SecuritySystemUser;
use App\SecuritySystemRole;
use App\SprutRole;
use App\SecuritySystemUserUserB17AB75B;
use Carbon\Carbon;
use DB;
use Hash;
class AbonentController extends Controller
{
    public function getAllAbonent(){
    	//$abonents=Abonent::all();
    	
    	$abonents = DB::table('ABONENT')->leftjoin('PERSONS', 'PERSONS.PRS_AB_ID', '=', 'ABONENT.AB_ID')->get();
    	return response()->json($abonents,200,[], JSON_UNESCAPED_UNICODE);
    }

    public function getAllAbonentTypes(){
    	$ab_type = AbonentType::all();
    	return response()->json($ab_type,200);
    }

    public function saveAbonent(){
    	try {

	    	$AB_ID    	 = 0;
	    	$PRS_ID 	 = 0;
		    $AB_NAME     = "";
		    $AB_TYPE     = ""; 
		    $AB_ADR_ID   = ""; 
		    $PRS_NAME1   = "";
		    $PRS_NAME2   = "";
		    $AB_REM      = "";
		    $PRS_NAME    = "";
		    $PRS_PHONEH  = "";
		    $PRS_PHONEW  = "";
		    $PRS_PHONEM  = "";
		    $PRS_PHONEM1 = "";
		    $PRS_PHONEM2 = "";
		    $PRS_PHONEM3 = "";
		    $PRS_EMAIL   = "";
		    $PRS_EMAIL1  = "";
		    $PRS_EMAIL2  = "";
		    $PRS_EMAIL3  = "";

		    $RPS_PHOTO   = "";

		    $edit = 0;

		    $Oid 	 = uniqid('sprut-user_', true);
		    $OidRole = uniqid('sprut-role_', true);

		    if(isset(request()->edit) || !empty(request()->edit)){
		    	$edit = request()->edit;
		    }

		    if(isset(request()->AB_ID) || !empty(request()->AB_ID)){
		    	$AB_ID = request()->AB_ID;
		    }

		    if(isset(request()->PRS_ID) || !empty(request()->PRS_ID)){
		    	$PRS_ID = request()->PRS_ID;
		    }

		    if(!isset(request()->AB_NAME) || empty(request()->AB_NAME)){
		    	return response()->json("Ошибка, название не может быть пустым!",400,[], JSON_UNESCAPED_UNICODE);
		    }

		    if(!isset(request()->PRS_EMAIL) || empty(request()->PRS_EMAIL)){
		    	return response()->json("Ошибка, email не может быть пустым!",400,[], JSON_UNESCAPED_UNICODE);
		    }

		    //Поиск  Персоны по email
		    $findEmail = Persons::where('PRS_EMAIL','=',request()->PRS_EMAIL)->first();
		    if($findEmail && $edit==0){
		    	return response()->json("Ошибка, Пользователь с таким Email уже существует! ",400,[], JSON_UNESCAPED_UNICODE);
		    }

		    if(!isset(request()->AB_TYPE)){
		    	return response()->json("Ошибка, Нужно выбрать тип абонента!",400,[], JSON_UNESCAPED_UNICODE);
		    }

		    if(isset(request()->PRS_NAME1) || !empty(request()->PRS_NAME1)){
		    	$PRS_NAME1 = request()->PRS_NAME1;
		    }

		    if(isset(request()->PRS_NAME2) || !empty(request()->PRS_NAME2)){
		    	$PRS_NAME2 = request()->PRS_NAME2;
		    }

		    if(isset(request()->AB_REM) || !empty(request()->AB_REM)){
		    	$AB_REM = request()->AB_REM;
		    }

		    if(isset(request()->PRS_NAME) || !empty(request()->PRS_NAME)){
		    	$PRS_NAME = request()->PRS_NAME;
		    }

		    if(isset(request()->PRS_PHONEH) || !empty(request()->PRS_PHONEH)){
		    	$PRS_PHONEH = request()->PRS_PHONEH;
		    }

		    if(isset(request()->PRS_PHONEW) || !empty(request()->PRS_PHONEW)){
		    	$PRS_PHONEW = request()->PRS_PHONEW;
		    }

		    if(isset(request()->PRS_PHONEM) || !empty(request()->PRS_PHONEM)){
		    	$PRS_PHONEM = request()->PRS_PHONEM;
		    }

		    if(isset(request()->PRS_PHONEM1) || !empty(request()->PRS_PHONEM1)){
		    	$PRS_PHONEM1 = request()->PRS_PHONEM1;
		    }

		    if(isset(request()->PRS_PHONEM2) || !empty(request()->PRS_PHONEM2)){
		    	$PRS_PHONEM2 = request()->PRS_PHONEM2;
		    }

		    if(isset(request()->PRS_PHONEM3) || !empty(request()->PRS_PHONEM3)){
		    	$PRS_PHONEM3 = request()->PRS_PHONEM3;
		    }

		    if(isset(request()->PRS_EMAIL1) || !empty(request()->PRS_EMAIL1)){
		    	$PRS_EMAIL1 = request()->PRS_EMAIL1;
		    }

		    if(isset(request()->PRS_EMAIL2) || !empty(request()->PRS_EMAIL2)){
		    	$PRS_EMAIL2 = request()->PRS_EMAIL2;
		    }

		    if(isset(request()->PRS_EMAIL3) || !empty(request()->PRS_EMAIL3)){
		    	$PRS_EMAIL3 = request()->PRS_EMAIL3;
		    }

		    $AB_NAME 	= request()->AB_NAME;
		    $PRS_EMAIL 	= request()->PRS_EMAIL;
	    	$AB_TYPE    = request()->AB_TYPE;


	    	//Создаем абонента
	    	$ab = null;
	    	if($edit==0 || $AB_ID==0){

	    		$_ab= Abonent::all()->max('AB_ID');
		    	if($_ab && $_ab>0){
		    		$AB_ID = $_ab;
		    	}

		    	$ab = new Abonent;
		    	$ab->AB_ID  	= $AB_ID+1;
	    	}else{

	    		if($findEmail && $edit==0){
		    	return response()->json("Ошибка, Пользователь с таким Email уже существует! ",400,[], JSON_UNESCAPED_UNICODE);
		    	}
	    		$ab = Abonent::where('AB_ID','=', $AB_ID )->get()->first();
	    	}

	    	$ab->AB_NUM 	= $AB_TYPE;
	    	$ab->AB_TYPE 	= $AB_TYPE;
	    	$ab->AB_NAME 	= $AB_NAME;
	    	$ab->AB_NAME1	= $PRS_NAME1;
	    	$ab->AB_NAME2	= $PRS_NAME2;
	    	$ab->AB_ADR_ID	= $AB_ADR_ID;
	    	$ab->AB_REM		= $AB_REM;
	    	$ab->save();

	    	if($edit==0){
				//Создаем SecuritySystemUser
		    	$ssu = new SecuritySystemUser;
		    	$ssu->Oid 							= $Oid;
				//$ssu->StoredPassword				= $fp = fopen($filename, 'rb');
		    	$ssu->ChangePasswordOnFirstLogon	= 0;
		    	$ssu->UserName 						= $PRS_EMAIL;
		    	$ssu->IsActive						= 1;
		    	$ssu->ObjectType					= 4;
		    	$ssu->save();
		    
		    	//Создаем SprutUser
		    	$su = new SprutUser;
		    	$su->Oid 				= $Oid;
		    	$su->ABONENT 			= $ab->AB_ID;
		    	//$su->PERSON    			= $pr->PRS_AB_ID;
		    	$su->CAN_EDIT_LAYOUT	= 0;
		    	$su->TYPE 				= 0;
		    	$su->save();
	    	}

	    	$pr = null;
	    	if($edit==0){
	    	//Создаем персону
		    	$_pr= Persons::all()->max('PRS_ID');
		    	
		    	if($_pr && $_pr>0){
		    		$PRS_ID = $_pr;
		    	}

		    	$pr = new Persons;
		    	$pr->PRS_ID 		= $PRS_ID+1;
		    	$pr->PRS_USER 		= $Oid;
		    }else{
		    	$pr = Persons::where('PRS_ID','=', $PRS_ID )->get()->first();
		    }
		    $pr->PRS_AB_ID		= $ab->AB_ID;
		    $pr->PRS_NAME		= $PRS_NAME;
		    $pr->PRS_NAME1		= $PRS_NAME1;
		    $pr->PRS_NAME2		= $PRS_NAME2;
		    $pr->PRS_PHONEH		= $PRS_PHONEH;
		    $pr->PRS_PHONEW		= $PRS_PHONEW;
		    $pr->PRS_PHONEM		= $PRS_PHONEM;
		    $pr->PRS_PHONEM1	= $PRS_PHONEM1;
		    $pr->PRS_PHONEM2	= $PRS_PHONEM2;
		    $pr->PRS_PHONEM3	= $PRS_PHONEM3;
		    $pr->PRS_EMAIL   	= $PRS_EMAIL;
		    $pr->PRS_EMAIL1   	= $PRS_EMAIL1;
		    $pr->PRS_EMAIL2   	= $PRS_EMAIL2;
		    $pr->PRS_EMAIL3   	= $PRS_EMAIL3;
		    //$pr->PRS_PHOTO		= $PRS_PHOTO;
		    $pr->save();
			
			if($edit==0){	
				$su->PERSON = $pr->PRS_ID;
				$su->save();

		    	//Создаем SecuritySystemRole
		    	$ssr = new SecuritySystemRole;
		    	$ssr->Oid 					= $OidRole;
		    	$ssr->OptimisticLockField	= 1;
		    	$ssr->ObjectType			= 2;
		    	$ssr->Name 					= "СПРУТ-М Роль ".Carbon::now()->format('Y-m-d H:i:s');;
		    	$ssr->IsAdministrative      = 0;
		    	$ssr->CanEditModel 			= 0;
		    	$ssr->save();

		    	//Создаем SprutRole
		    	$sr = new SprutRole;
		    	$sr->Oid 			= $OidRole;
		    	$sr->ACCESS_TYPE	= 0;
		    	$sr->save();

		    	//Создаем связь SecuritySystemUserUser_B17AB75B
		    	$ssuu = new SecuritySystemUserUserB17AB75B;
		    	$ssuu->OID 		= uniqid('B17AB75B_', true);
		    	$ssuu->Roles	= $OidRole;
		    	$ssuu->Users  	= $Oid;
		    	$ssuu->save();
	    	}
			
	    	return  response()->json("Все отлично!",200,[], JSON_UNESCAPED_UNICODE);
    	} catch (Exception $e) {
    		return response()->json("Ошибка! ".$e->getMessage(),400,[], JSON_UNESCAPED_UNICODE);
    	}
    }

    public function deleteAbonent(){
    	try{
    		$AB_ID    	 = 0;
	    	$PRS_ID 	 = 0;
    		if(isset(request()->AB_ID) || !empty(request()->AB_ID)){
		    	$AB_ID = request()->AB_ID;
		    }

		    if(isset(request()->PRS_ID) || !empty(request()->PRS_ID)){
		    	$PRS_ID = request()->PRS_ID;
		    }

		    if($AB_ID == 0 || $PRS_ID == 0){
		    	return response()->json("Ошибка! Удаления ",400,[], JSON_UNESCAPED_UNICODE);
		    }

		    $ab = Abonent::where('AB_ID','=', $AB_ID )->get()->first();
		    $pr = Persons::where('PRS_ID','=', $PRS_ID )->get()->first();

		    if(!$pr){
		    	return response()->json("Ошибка, удаления. Персона не найдена!".$pr,400,[], JSON_UNESCAPED_UNICODE);
		    }

		    $roleOid = SecuritySystemUserUserB17AB75B::where('Users','=', $pr->PRS_USER)->get()->first();

		    $pr->PRS_USER = null;
		    $pr->save();


		    if($roleOid){
		    	$rid_u = $roleOid->Users;
		    	$rid_r = $roleOid->Roles;
		    	$roleOid->delete();
		    	SprutUser::where('Oid','=',$rid_u)->delete();
		    	SecuritySystemUser::where("Oid",'=',$rid_u)->delete();	
		    	SprutRole::where('Oid','=',$rid_r)->delete();
		    	SecuritySystemRole::where('Oid','=',$rid_r)->delete();
		    }

		    $pr = Persons::where('PRS_ID','=', $PRS_ID )->get()->first();
		    $pr->delete();
		    $ab->delete();
		    return response()->json("Абонент успешно удален!",202,[], JSON_UNESCAPED_UNICODE);

    	}catch(Exception $e){
    		return response()->json("Ошибка! ".$e->getMessage(),400,[], JSON_UNESCAPED_UNICODE);
    	}
    	return response()->json("Абонент успешно удален!",202,[], JSON_UNESCAPED_UNICODE);
    }

    public function testSql(){
    	$pr = Persons::where('PRS_ID','=', request()->PRS_ID )->get()->first();

		    if(!$pr){
		    	return response()->json("Ошибка, удаления. Персона не найдена!".$pr,400,[], JSON_UNESCAPED_UNICODE);
		    }
				
    	return (json_encode($pr));
    }
}