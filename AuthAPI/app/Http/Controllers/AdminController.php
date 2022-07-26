<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Validator;
use App\Mail\AdminMaileable;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct() 
    {
        $this->middleware('CheckApi',['except' => ['datosVerify','send']]);
    }


    public function datosVerify(Request $request)  
    {
        //Validaciónes de los campos con su registros por parte del administrador 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'addres' => 'required|string|max:50',
            'email' => 'required|string|min:3',
            'logo' =>'string|max: 40',
            'phone' =>'required|string|max:50',
            'RRD' => 'required|string|max:255',
            'fundation' => 'date',
            'name_terrain' => 'required|string|max:50',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        //return view('Email.ingreso',compact('request'));

        //$this->send($request->all());  //Envia el correo (llama a la funcion enviar)
        $this->sendi();
    }

    public function sendi()   //Envia el correo con la vista
    {
        $token = $this->createToken(); 

        $correo = new AdminMaileable($token);
        Mail::to('Administracion@gamaiul.com')->send($correo,$token);
        return response()->json(['message' => 'Su inrformación estara en espera para verificar']);
    }

    protected function respondWithToken($token) //Devuelve un token de tipo bearer
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
    public function createToken() //Crea un nuevo token y lo cambio 
    {

        $token = Str::random(40);
        return $token;
    }

}
