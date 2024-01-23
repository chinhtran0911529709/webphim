<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use GMP;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        //
        $soluong_phim=Movie::count();
        $list = Genre::all();
        $soluong_user  = User::where('role',1)->count();
        return view('admincp.genre.index',compact('list','soluong_phim','soluong_user'));
        }
        else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();
        
        return view('admincp.genre.form',compact('soluong_phim','soluong_user'));
        }
        else{
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        toastr()->success('Thêm mới thành công');
        return redirect()->back(); // trở về trang trước đó

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        //
        $genre = Genre::find($id);
        $list = Genre::all();
        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();
        return view('admincp.genre.form',compact('list','genre','soluong_phim','soluong_user'));
        }
        else{
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $genre = Genre::find($id);
        if($genre!= null)
        {
            $data = $request->all();
            $genre->title = $data['title'];
            $genre->slug = $data['slug'];
            $genre->description = $data['description'];
            $genre->status = $data['status'];
            $genre->save();
            toastr()->success('Cập nhật thành công');

            return redirect()->back();
        }
        else{
            echo 'có lỗi';
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        Genre::find($id)->delete();
        toastr()->success('xóa thành công');

        return redirect()->back();
        }
        else{
            return redirect()->route('login');
        }
    }
}
