<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {





        // Create a new user in the database
        $user = User::create($request->validated());

        // Generate a token for the user
        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        // Return success response with user data and token
        $response = [
            'status' => 'success',
            'message' => 'User is created successfully.',
            'data' => $data,
        ];

        return response()->json($response, 201);
    }


    public function login(Request $request)
    {
        // Validate user input (email and password)
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            // Return error response with validation errors if validation fails
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validator->errors(),
            ], 403);
        }

        // Check if the email exists in the database
        $user = User::where('email', $request->email)->first();

        // Check if password matches the one stored in the database
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Return error
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate a token for the user
        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        // Return success response with user data and token
        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }
}
