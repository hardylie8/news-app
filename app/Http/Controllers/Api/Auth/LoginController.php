<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'bail|required|string|email|min:11|exists:users,email',
            // 'password' => 'bail|required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'password' => 'bail|required|string|min:6',
        ];

        $messages = [
            'email.exists' => 'Either your account is unregistered or not yet verified. Please register or verify first!',
            'password.regex' => ' password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response([
                "status" => 422,
                "message" => "The given data was invalid.",
                'results' => null,
                'errors' => $validator->errors()
            ], 200);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->email_verified_at == null) {
                return  response([
                    'status' => 422,
                    'message' => 'Email not verified. verify email first',
                    'results' => null
                ], 200);
            }
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->plainTextToken;

                return response([
                    'status' => 200,
                    'message' => 'You have successfully logged in!',
                    'results' => [
                        'type' => 'Bearer',
                        'token' => $token,
                        'user'  => $user->only(['id', 'name', 'email',  'country_code_name', 'country_code', 'phone', 'original_image'])
                    ]
                ], 200);
            }

            return response([
                'status' => 422,
                'message' => 'Email and password don\'t match!',
                'results' => null
            ], 200);
        }

        return  response([
            'status' => 422,
            'message' => 'User does not exist',
            'results' => null
        ], 200);
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     *@return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     */
    public function logout(Request $request)
    {
        optional(auth()->guard(config('api.api_guard'))->user())
            ->currentAccessToken()
            ->delete();

        // $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return  response([
            'status' => 200,
            'message' => 'You have been successfully logged out!',
            'results' => null
        ], 200);
    }
}
