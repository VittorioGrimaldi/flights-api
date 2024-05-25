<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

# In Postman, add accept: application/json in the header for seeing validation errors

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            // Check if the user already exists
            $user = User::where('email', $request->email)->first();

            if ($user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User already exists'
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Server Error'
            ]);
        }
    }
}
