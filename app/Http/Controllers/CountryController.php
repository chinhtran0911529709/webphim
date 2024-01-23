<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(session()->has('user_id') && session()->get('user_role')==0){

        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();
        $list = Country::all();
        return view('admincp.country.index',compact('list','soluong_phim','soluong_user'));
        }
        else
        {
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
        return view('admincp.country.form',compact('soluong_phim','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $country = new Country();
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
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
        $country = Country::find($id);
        $list = Country::all();
        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();
        return view('admincp.country.form',compact('list','country','soluong_phim','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $country = Country::find($id);
        if($country!= null)
        {
            $data = $request->all();
            $country->title = $data['title'];
            $country->slug = $data['slug'];
            $country->description = $data['description'];
            $country->status = $data['status'];
            $country->save();
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

        Country::find($id)->delete();
        toastr()->success('xóa thành công');

        return redirect()->back();
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
