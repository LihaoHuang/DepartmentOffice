<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserPostRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('show', Auth::user()) && Auth::user()->cannot('member')){
            $obtain = User::orderBy('id','DESC');
            return view('pages.manager',['mainTitle' => '人員管理','results' => $obtain->paginate(11),'obtainArr' => $obtain->get()]);        
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        if(Gate::allows('show', Auth::user()) && Auth::user()->cannot('member')){
            if(empty($findUser = User::select()->where('email',$request['email'])->first())){
             User::create($request->except('_token'));
            }else
            {
                return redirect()->to('manager')->with('errMail','此信箱已存在。');
            }
            return redirect()->route('manager');
        }
        return redirect()->route('home');
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
    public function update(UserPostRequest $request, $id)
    {
        if(Gate::allows('show', Auth::user()) && Auth::user()->cannot('member')){
            User::find($id)->update($request->except('_token'));
            return redirect()->route('manager');
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('show', Auth::user()) && Auth::user()->cannot('member')){
            User::destroy($id);
            return redirect()->route('manager');
        }
        return redirect()->route('home');
    }
}
