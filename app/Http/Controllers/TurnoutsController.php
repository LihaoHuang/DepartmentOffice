<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Illuminate\Http\Request;
use App\Models\Turnout;
use App\Http\Requests\VotePostRequest;
use Illuminate\Support\Facades\Input;
use Storage;

class TurnoutsController extends Controller
{
    /**x
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        $obtain =  Turnout::orderBy('id','DESC');
        //paginate()會將結果陣列，自動格式成他需要的樣子，而其不為JSON格式陣列，故無法成為物件陣列。get()則為一JSON格式之陣列，故可被JS的物件陣列使用。
        return view('pages.vote',['mainTitle' => '投票區','results' => $obtain->paginate(11) ,'obtainArr' => $obtain->get()]);
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
    public function store(VotePostRequest $request)
    {  
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        Turnout::create($request->except('_token'));
        foreach(range(1,10) as $i) {
            if ($request->hasFile('fileName'.$i)) {                                     //有沒有這個檔案
                $file = $request->file('fileName'.$i);                                  //取得檔案
                $original_name = $file->getClientOriginalName();                        //Laravel會儲存當案仍在暫存區時的名字，所以之後要把他更斤成正確檔名。                                                          
                if($file->isValid()) {                                                  //檔案是否有效 
                    $file->move(storage_path('app/Filebase/'), $original_name);         //移動檔案     
                    Turnout::all()->last()->update(['fileName'.$i => $original_name]);  //更新
                }
            }
        }
        return redirect()->route('vote');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        return view('pages.static',['get' => Turnout::find($id)]);
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
    public function update(Request $request, $id)
    {
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        $item = Turnout::find($id);
        $old_file_arr = Array();
        $new_file_arr = Array();
        //把要更新的檔案及舊檔名放入陣列。
        foreach (range(1,10) as $key) {
            if($request->hasFile('fileName'.$key)){
                if(!empty($item['fileName'.$key]))
                    $old_file_arr   = array_add($old_file_arr , $key   , $item['fileName'.$key]);
                $new_file_arr   = array_add($new_file_arr , $key   , $request->file('fileName'.$key)); //取新檔案
            }
        }
        $item->update($request->except('_token'));                          //在這時，先把資料更新，因為目前有被更新的檔名應為暫存檔名。        
        //刪除並更換檔案
        foreach($new_file_arr as $key => $file){
            $original_name = $file->getClientOriginalName();  
            if($file->isValid()){                                                           //若新資料為有效資料
                if(isset($old_file_arr[$key]))           //舊檔案是否存在
                    Storage::delete('Filebase/'.$old_file_arr[$key]);                       //再把舊檔刪除                 
                $file->move(storage_path('app/Filebase/'),$original_name);                  //然後新檔移入
                $item->update(['fileName'.$key => $original_name]);                         //將暫存檔名更換為真檔名
            }
        }
        return redirect()->route('vote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        // Turnout::destroy($id);

        $item = Turnout::find($id);
        for ($i=1 ; !empty($item['fileName'.$i]) ; $i++) {
            // 預設且真的會刪除的路徑為 storage/app/ ，故將資料夾放在這裡。
            Storage::delete('Filebase/'.$item['fileName'.$i]);       
        }
        $item->delete();
        return redirect()->route('vote');
    }


    public function download($fileName)
    {
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        return response()->download(storage_path('app/Filebase/').$fileName);
    }
}
