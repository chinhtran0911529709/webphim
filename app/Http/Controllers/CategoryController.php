<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session()->has('user_id') && session()->get('user_role')==0){
        //
        $list = Category::all();
        // get so luong phim
        $soluong_phim = Movie::count();
        $soluong_user  = User::where('role',1)->count();
        // dd($soluong_phim);
        return view('admincp.category.index',compact('list','soluong_phim','soluong_user'));
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
        $soluong_phim = Movie::count();
        $soluong_user  = User::where('role',1)->count();
        return view('admincp.category.form',compact('soluong_phim','soluong_user'));
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
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->save();
        toastr()->success('Tạo danh mục thành công');
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
        //
        if(session()->has('user_id') && session()->get('user_role')==0){

        $category = Category::find($id);
        $list = Category::all();
        $soluong_phim = Movie::count();
        $soluong_user  = User::where('role',1)->count();
        return view('admincp.category.form',compact('list','category','soluong_phim','soluong_user'));
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
        
        $category = Category::find($id);
        if($category!= null)
        {
            $data = $request->all();
            $category->title = $data['title'];
            $category->slug = $data['slug'];
            $category->description = $data['description'];
            $category->status = $data['status'];
            $category->save();
            toastr()->success('Cập nhật thành công');
            return redirect()->back();
        }
        else{
            toastr()->error('Có lỗi xảy ra khi update. Update thất bại');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        try{
            DB::beginTransaction();
            $categoryId = $id;
            // xóa bản ghi có id = categoryId trong bảng category
            Category::find($categoryId)->delete();
            // lấy toàn bộ bản ghi trong movie có category_id = $categoryId
            $movies = Movie::where('category_id',$categoryId)->get();
            foreach($movies as $movie)
            {
                $movie->category_id = null;
                $movie->save;
            }
            DB::commit();
            // xóa và cập nhật thành công
            toastr()->success('xóa thành công');


        }
        catch(ModelNotFoundException $exception)
        {
            // k tìm thấy bản ghi category cần xóa
            // xử lý lỗi hoặc thông báo lỗi cho ng dùng
            // rollback: hoàn tác các giá trị đã thay đổi
            DB::rollBack();
        }
        catch(\Exception $exception)
        {
            DB::rollBack();
        }
        return redirect()->back();
        //
        // xóa mà k có try catch
        // Category::find($id)->delete();
        // return redirect()->back();
        }
        else{
            return redirect()->route('login');
        }

    }
}
