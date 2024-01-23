<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\User_Movie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    

    public function index()
    {
        if(session()->has('user_id') && session()->get('user_role')==0){
        $soluong_phim=Movie::count();
        $list = User::where('role',1)->get();
        $soluong_user  = User::where('role',1)->count();

        return view('admincp.user.index',compact('soluong_phim','list','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }
    }
    public function destroy(string $id)
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        $user_delete = User::where('id',$id)->first();
        // xóa user thì xóa phim user đã thích
        User_Movie::where('user_id')->delete();
        $user_delete->delete();
        toastr()->success('xóa thành công');

        return redirect()->back();
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
