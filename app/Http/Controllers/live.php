<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class live extends Controller{

    public function home(){
        $data=DB::table('massage')->orderBy('id', 'desc')->get();
        return view('crud.insert',['data'=>$data]);
    }
    public function add(Request $request){
        $email=$request->email;
        $massage=$request->massage;
        $d=DB::table('massage')->insert([
            'email'=>$email,
            'massage'=>$massage
        ]);
        $id=DB::getPdo()->lastInsertId();
        return response()->json([
            'id'=>$id,
            'email'=>$email,
            'massage'=>$massage
        ]);
    }
    public function delete($id){
        DB::table('massage')->where('id',$id)->delete();
        return response()->json([
            'id'=>$id
        ]);
    }
    public function view(Request $request){
        $id=$request->id;
        $data=DB::table('massage')->where('id',$id)->first();
        $id=$data->id;
        $email=$data->email;        
        $massage=$data->massage;

        return response()->json([
            'id'=>$id,
            'email'=>$email,
            'massage'=>$massage
        ]);
    }
    public function edit(Request $request){
        $id=$request->id;
        $email=$request->email;
        $massage=$request->massage;
        
       DB::table('massage')
        ->where('id',$id)
        ->update([
            'email'=>$email,
            'massage'=>$massage
        ]);
        $data=DB::table('massage')->where('id',$id)->first();
        $id=$data->id;
        $email=$data->email;        
        $massage=$data->massage;

        return response()->json([
            'id'=>$id,
            'email'=>$email,
            'massage'=>$massage
        ]);
        
    }
    public function one(){
        return view("one");
    }
 
}
