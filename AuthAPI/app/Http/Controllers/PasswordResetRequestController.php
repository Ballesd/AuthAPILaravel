<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetRequestController extends Controller
{
    public function sendEmail(Request $request)  //Duncion importante, manda el email de cambio de contraseña 
    {
        if (!$this->validateEmail($request->email)) {   //  Valida el correo si existe 
            return $this->failedResponse();
        }
        $this->send($request->email);  //Envia el correo (llama a la funcion enviar)
        return $this->successResponse();
    }

    public function send($email)   //Envia el correo con la vista
    {
        $token = $this->createToken($email); 
        Mail::to($email)->send(new SendMailreset($token, $email));  //Metodo Mail
    }

    public function createToken($email) //Crea un nuevo token y lo cambio 
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken) {
            return $oldToken->token;
        }

        $token = Str::random(40);
        $this->saveToken($token, $email); //Guarda el token
        return $token;
    }


    public function saveToken($token, $email)   //Guarda el token 
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    public function validateEmail($email)  
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'error' => 'El correo electrónico \'t no se encuentra en nuestra base de datos.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'Se ha enviado a su correo electronico, por favor revisa tu inbox.'
        ], Response::HTTP_OK);
    }
}