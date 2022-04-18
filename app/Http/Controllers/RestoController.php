<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Session;
use Crypt;
class RestoController extends Controller
{
    
    function index()
    {
        return view('home') ;
    }
    function list()
    {
        $data = Restaurant::all();
        return view('list',["data"=>$data]);
    }
    function add(Request $req)
    {
       // return $req->input();
       $resto = new Restaurant;
       $resto->name=$req->input('name');
       $resto->email=$req->input('email');
       $resto->address=$req->input('address');
       $resto->save();
       $req->Session()->flash('status','Resturant submitted successfully');
       return redirect('list');
    }
    function delete($id)
    {
      Restaurant::find($id)->delete();
      Session::flash('status','Resturant delete successfully');
      return redirect('list');
    }

    function edit($id)
    {
        $data= Restaurant::find($id);
     return view('edit',['data'=>$data]);
      
    }

    function update(Request $req)
    {
       $resto = Restaurant::find($req->input('id'));
       $resto->name=$req->input('name');
       $resto->email=$req->input('email');
       $resto->address=$req->input('address');
       $resto->save();
       $req->Session()->flash('status','Resturant updated successfully');
       return redirect('list');
    }
    function register(Request $req)
    {
        //echo Crypt :: encrypt('123@abc');
        //return $req->input();
        $user = new User;
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->password= Crypt :: encrypt ($req->input('password'));
        $user->contact=$req->input('contact');
        $user->save();
    }
}
