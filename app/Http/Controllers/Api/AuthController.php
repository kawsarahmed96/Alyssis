<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Mail\OtpSend;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::create([
            'name' => $request->name ?? 'name_' . uniqid(),
            'username' => $request->username ?? "username_" . time(),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'last_login_at' => now()
        ]);
        return response()->json([
            'user' => $user,
            'message' => 'User created successfully',

        ]);
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $token = Auth::guard('api')->attempt($request->only('email', 'password'));

        if (!$token) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::guard('api')->user();
        $user->last_login_at = now();
        $user->save();

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'message' => 'Login successful',
            'user' => Auth::guard('api')->user()
        ]);
    }


    public function logout()
    {
        try {

            $token = JWTAuth::getToken();

            if (!$token) {

                return response()->json(['error' => 'Token not provided'], 401);
            }

            JWTAuth::invalidate($token);

            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }


    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $otp = rand(100000, 999999); // 6 digit code
        $expiresAt = Carbon::now()->addMinutes(1);

        // Save OTP to DB
        $user = User::where('email', $request->email)->first();
        $user->otp = $otp;
        $user->otp_expired_at = $expiresAt;
        $user->save();

        Mail::to($request->email)->send(new OtpSend($otp));

        return response()->json([
            'status' => 200,
            'otp' => $otp,
            'message' => 'OTP sent successfully'
        ]);
    }


    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::where('otp', $request->otp)->where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid otp',
            ]);
        } else if ($user->otp_expired_at < Carbon::now()) {

            $user->otp = null;
            $user->otp_expired_at = null;
            $user->save();

            return response()->json([
                'status' => 400,
                'message' => 'OTP expired',

            ]);
        }

        $user->otp_verified_at = Carbon::now();
        $user->save();

        return response()->json([
            'status' => 200,
            'user' => $user->email,
            'message' => 'OTP verified successfully'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email',
        ]);

        if (!$request->email) {
            return response()->json([
                'status' => 400,
                'message' => 'User not found',
            ]);
        }


        $user = User::where('id', $request->email)->first();
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Password reset successfully'
        ]);
    }
    
}
