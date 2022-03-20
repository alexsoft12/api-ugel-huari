<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'Login Successful.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function user(Request $request)
    {
        $user = $request->user();
        return $this->sendResponse($user, 'User retrieved successfully.');
    }

    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        return $this->sendResponse([], 'User logged out successfully.');
    }
}
