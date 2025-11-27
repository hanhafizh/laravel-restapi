<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        // if (!auth()->attempt($credentials)) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        /* Login gagal — email atau password salah */
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credentials are not valid'], 401);
        }

        /* Buat token saat login */
        /** @var \App\Models\User $user */

        $user = Auth::user();

        return response()->json([
            'token' => $user->createToken('apitodos')->plainTextToken
        ]);
    }
}
