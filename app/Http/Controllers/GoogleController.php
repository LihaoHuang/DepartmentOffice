<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Socialite;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class GoogleController extends Controller
{   
    public function __construct(){
        Carbon::now()->setTimezone('Asia/Taipei');
    }

    /** 
     * 重導使用者到 Google 認證頁。
     *
     * @return Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * 從 Google 得到使用者資訊
     *
     * @return Response
     */
    public function handleGoogleCallback()
    {
        if($user = Socialite::driver('google')->user()){
            if($find_user = User::select()->where('email','=',$user->email)->first()){
                if(empty($find_user->name)) $find_user->update(['name' => $user->name]);
                Auth::login($find_user);
            }else if(preg_match("/@gm.nfu.edu.tw/",$user->email)){
                $add_user = User::create([
                    'name' => $user->name,
                    'email' => $user->email
                ]);
                Auth::login($add_user);
            }else {
                return redirect()->to('/login')->with('errMail','請重新以虎尾科大信箱登入，並再次拜訪本網站。');
            }
            // Storing user infomation to log
            Log::create([
                'logInAC' => Auth::user()->name,
                'logInTime' => Carbon::now()->setTimezone('Asia/Taipei'),
                'IP' => $_SERVER['REMOTE_ADDR']
            ]);

            return redirect()->route('home');
            
            // $user->token;
        }
    }

}