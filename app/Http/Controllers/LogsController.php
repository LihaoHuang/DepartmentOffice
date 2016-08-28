<?php

namespace App\Http\Controllers;
use Auth;
use Gate;
use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('show', Auth::user()) && Auth::user()->cannot('member')){
            $obtain = Log::orderBy('id','DESC');
            //paginate()會將結果陣列，自動格式成他需要的樣子，而其不為JSON格式陣列，故無法成為物件陣列。get()則為一JSON格式之陣列，故可被JS的物件陣列使用。
            return view('pages.log',['mainTitle' => 'Log資訊','results' => $obtain->paginate(13),'obtainArr' => $obtain->get()]);
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::create([
            'logInAC' => Auth::user()->name,
            'logInTime' => Carbon::now()->setTimezone('Asia/Taipei'),
            'IP' => $_SERVER['REMOTE_ADDR']
        ]);
        return redirect()->route('home')->with('message','登入成功!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        //  Using GoogleController to store.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request['logOutTime'] = Carbon::now()->setTimezone('Asia/Taipei');
        Log::all()->last()->update($request->except('_token'));
        Auth::logout();
        return redirect()->to('/login')->with('logout','已登出本系統!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
