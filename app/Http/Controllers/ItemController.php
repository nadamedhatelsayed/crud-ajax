<?php

namespace App\Http\Controllers;

use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = item::orderBy('id','desc')->paginate(5);

       return view('ajax.index',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = item::updateOrCreate(
            ['id' => $request->user_id],
            ['name' => $request->name ]
        );
        return response()->json($user);
       
    }

    public function edit($id)
    {
        
        $user  = item::where('id',$id)->first();
        return response()->json($user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = item::where('id',$id)->delete();
        return response()->json($user);
    }

   public function fetch_data(Request $request)
    {
     if($request->ajax())
      {
         $users = DB::table('items')->paginate(5);
         return view('ajax.index', compact('users'))->render();
      }
    }
}
