<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function passwordResetProcess(UpdatePasswordRequest $request){
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
      }
  
      // Verifica si el token es valido 
      private function updatePasswordRow($request){
         return DB::table('password_resets')->where([
             'email' => $request->email,
             'token' => $request->resetToken
         ]);
      }
  
      // Si el Token no funciona da una respuesta  
      private function tokenNotFoundError() {
          return response()->json([
            'error' => 'Correo electronico o token equivocado.'
          ],Response::HTTP_UNPROCESSABLE_ENTITY);
      }
  
      // Reset password
      private function resetPassword($request) {
          // Encuentra email
          $userData = User::whereEmail($request->email)->first();
          // Edita la password
          $userData->update([
            'password'=>bcrypt($request->password)
          ]);
          // remueve la verificacion de la informacion de la db
          $this->updatePasswordRow($request)->delete();
  
          // Cambia la password y da respuesta
          return response()->json([
            'data'=>'La contraseña se ha cambiado.'
          ],Response::HTTP_CREATED);
      }    
}