<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function callback(Request $request)
    {
        if($request->input('state') !== csrf_token()){
            abort(401, '状态码失效，请重新再试');
        }
        $client = new \GuzzleHttp\Client();
        //获取access_token
        $httpRequest = $client->request('GET', env('OAUTH_HOST').'/oauth/access_token', ['query'=>[
            'grant_type' => 'authorization_code',
            'client_id' => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'redirect_uri' => env('OAUTH_REDIRECT_URL'),
            'code' => $request->input('code'),
        ]]);
        $reponse =  $httpRequest->getBody()->getContents();
        $res = json_decode($reponse, true);

        $http2Request = $client->request('GET',env('OAUTH_HOST').'/api/userinfo?access_token='.$res['access_token']);
        $response2 = $http2Request->getBody()->getContents();


        $info = json_decode($response2);
        $user = User::where('email', '=', $info->email)->first();
        if(!$user){
            $user = User::create([
                'uuid' => $info->id,
                'name' => $info->name,
                'qq' => $info->qq,
                'email' => $info->email
            ]);
        }
        
        try {
            if (! $token = JWTAuth::fromUser($user)) {
                abort(401, 'invalid_credentials');
            }
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            abort(500, 'could_not_create_token');
        }

        $data = ['token'=> $token, 'user'=>$user];
        $request->session()->put('JWTAuth', json_encode($data));
        return redirect('/');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $this->guard()->attempt($credentials);
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::attempt($request->only('email', 'password'));

        return response()->json(compact('token'));
    }

    public function userInfo()
    {
        $user = JWTAuth::parseToken()->authenticate();

        // If the token is invalid
        if (! $user) {
            return response()->json(['invalid user'], 401);
        }

        return response()->json([
            'id' => $user->id,
            'uuid' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function checkAuth(Request $request)
    {
        $session = $request->session();
        if(!$session->has('JWTAuth')){
            return response()->json(['invalid user'], 401);
        }
        $auth = json_decode($session->get('JWTAuth'));
        $session->forget('JWTAuth');
        return response()->json([
            'token'=>$auth->token,
            'user'=>[
                'uuid' => $auth->user->uuid,
                'name' => $auth->user->name,
                'email' => $auth->user->email
            ]
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
