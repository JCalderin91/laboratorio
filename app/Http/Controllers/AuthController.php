<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ApiController;
use App\Http\Requests\LoginUpdateRequest;
use App\Transformers\Transformers\LoginTransformer;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'changePassword']]);
        $this->middleware('transform.input:' . LoginTransformer::class)->only(['login']);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        
        
        $credentials = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'));

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $this->showOne(auth()->user())
        ]);
    }

    public function changePassword(LoginUpdateRequest $request){

        $account = Login::findOrFail($request->account_id);

        if (!(Hash::check($request->current_password, $account->password))) {
            // The passwords matches
            return $this->errorResponse("Your current password does not matches with the password you provided. Please try again.", 401);
        }
        if(strcmp($request->current_password, $request->password) == 0){
            //Current password and new password are same
            return $this->errorResponse("New Password cannot be same as your current password. Please choose a different password.", 401);
        }
       
        //Change Password
      
        $account->password = bcrypt($request->password);
        $account->save();
        return $this->showOne($account);
    }
}