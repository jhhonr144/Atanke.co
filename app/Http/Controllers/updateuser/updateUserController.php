<?php

namespace App\Http\Controllers\updateuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class updateUserController extends Controller
{
   
    public function updateuser(Request $request, $id)

    {
       
        try {
            $user = User::findOrFail($id);

           
             if ($request->password != null && !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => ' Se produjo un problema la es contraseña incorrecta'], 500);
            } 
            

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'required|min:5',
                'newPassword' => 'nullable|min:5',
                
            ]);

            /* if($request->newPassword != null){
              
              
            }
     */
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
    
            if (isset($validatedData['newPassword'])) {
                $user->password = Hash::make($validatedData['newPassword']);
            }

    
            $user->save();
    
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function listuser($id)
    {
        if (!$id) {
            return response()->json(['error' => 'ID no proporcionado'], 400);
        }
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    
}
