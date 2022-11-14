<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class UserController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);

        try {

            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            return response()->json([
                'status' => 'success',
                'respon code' => Response::HTTP_CREATED,
                'message' => 'Data has been successfully added.!',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $get_data = User::where('email', $request->email)->first();
        if (!$get_data) {
            return response()->json([
                'status' => 'failled',
                'respon code' => Response::HTTP_UNAUTHORIZED,
                'message' => "your input" . " " . "$request->email" . " " . "not valid / match"
            ]);
        }

        $isValidPassword = Hash::check($request->password, $get_data->password);
        if (!$isValidPassword) {
            return response()->json([
                'status' => 'failled',
                'respon code' => Response::HTTP_UNAUTHORIZED,
                'message' => "your input password not valid / match"
            ]);
        }

        $generateToken = bin2hex(random_bytes(10));

        $get_data->update([
            'token' => $generateToken
        ]);
        return response()->json([
            'status' => 'success',
            'respon code' => Response::HTTP_OK,
            'message' => 'your\'e logon.!',
            'data' => [
                'user' => $get_data->email,
                'access tokens' => $get_data->token
            ]
        ]);
    }
}