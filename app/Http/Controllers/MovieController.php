<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\User;
use App\Models\User_Movie;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        //mỗi khi admin chạy trang index của movie, file moviejson sẽ load lại để tải lại phim
        if(session()->has('user_id') && session()->get('user_role')==0){

        $list = Movie::with('category','movie_genre','country')->withCount('episode')->orderBy('id','DESC')->get();
        // return response()->json($list);
        // dd($list);
        //count sotap
        $soluong_phim = Movie::count();
        $soluong_user  = User::where('role',1)->count();
        $year_now = Carbon::now()->year;
        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        File::put($path.'movie.json',json_encode($list));


        return view('admincp.movie.index',compact('list','year_now','soluong_phim','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }

    }
    public function update_year(Request $request){
        $data = $request->all();
        //
        
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->orderBy('ngaycapnhat','DESC')->take(20)->get();
        $output = '';
        foreach($movie as $key => $mov)
        {
            if($mov->resolution==0){
                $text = 'HD';
            }
            else if($mov->resolution == 1){
                $text = 'SD';
            }
            else if($mov->resolution==2){
                $text = 'HDCam';
            }
            else if($mov->resolution==3)
            {
                $text = 'FullHD';
            }
            $output.='<div class="item post-37176">
            <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
               <div class="item-link">
                  <img src="'.url('upload/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                  <span class="is_trailer">'.$text.'</span>
               </div>
               <p class="title">'.$mov->title.'</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
            <div style="float: left;">
               <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
               <span style="width: 0%"></span>
               </span>
            </div>
         </div>';
        }
        echo $output;   
    }
    public function filter_default(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',0)->orderBy('ngaycapnhat','DESC')->take(20)->get();
        $output = '';
        foreach($movie as $key => $mov)
        {
            if($mov->resolution==0){
                $text = 'HD';
            }
            else if($mov->resolution == 1){
                $text = 'SD';
            }
            else if($mov->resolution==2){
                $text = 'HDCam';
            }
            else if($mov->resolution==3)
            {
                $text = 'FullHD';
            }
            $output.='<div class="item post-37176">
            <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
               <div class="item-link">
                  <img src="'.url('upload/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                  <span class="is_trailer">'.$text.'</span>
               </div>
               <p class="title">'.$mov->title.'</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
            <div style="float: left;">
               <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
               <span style="width: 0%"></span>
               </span>
            </div>
         </div>';
        }
        echo $output;   
    }
    public function update_topview(Request $request){
        $data = $request->all();
        //
        
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        if(session()->has('user_id') && session()->get('user_role')==0){
        
        $list_category = Category::all();
        $list_genre = Genre::all();
        $list_country = Country::all();
        $soluong_phim = Movie::count();
        $soluong_user  = User::where('role',1)->count();

        

        return view('admincp.movie.form',compact('list_category','list_genre','list_country','soluong_phim','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //
        $data = $request->all();
        // dd($data);
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->sotap = $data['sotap'];
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->session = $data['session'];
        $movie->slug = $data['slug'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->phude = $data['phude'];
        $movie->resolution = $data['resolution'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        // $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        // foreach($data['genre'] as $key => $gen)
        // {
        //     $movie->genre_id = $gen[0];
        // }
        
        // get image:
        $get_image = $request->file('image');
        $path = 'upload/movie/';
        // them hinh anh
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // vidu : hinhanh1.jpg
            $name_image = current(explode('.',$get_name_image)); //  no se tach ra thanh [0]=> hinhanh1 [1]=>jpg
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        // them nhieu theloai cho phim
        $movie->movie_genre()->attach($data['genre']);
        toastr()->success('Thêm mới thành công');
        return redirect()->route('movie.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        //
        if(session()->has('user_id') && session()->get('user_role')==0){
        
        // dd($data);
        $movie_edit = Movie::find($id);
        
        // return response()->json($movie_edit);
        $list = Movie::with('category','movie_genre','country')->orderBy('id','DESC')->get();
        $list_category = Category::all();
        $list_genre = Genre::all();
        $list_country = Country::all();
        $movie_edit_genre= $movie_edit->movie_genre;
        $soluong_phim = Movie::count();
        $soluong_user  = User::where('role',1)->count();
        
        // dd($list);
        return view('admincp.movie.form',compact('soluong_phim','soluong_user','list','list_category','list_genre','list_country','movie_edit','movie_edit_genre'));    
        }
        else
        {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        //
        $data = $request->all();
        // dd($data);
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->sotap = $data['sotap'];
        $movie->session = $data['session'];
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->resolution = $data['resolution'];
        $movie->phude = $data['phude'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        // $movie->genre_id = $data['genre_id'];
        // foreach($data['genre'] as $key => $gen)
        // {
        //     $movie->genre_id = $gen[0];
        // }
        $movie->country_id = $data['country_id'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        
        // get image:
        $get_image = $request->file('image');
        $path = 'upload/movie/';
        // them hinh anh
        if($get_image){
            if(file_exists('upload/movie/'.$movie->image))
            {
                unlink('upload/movie/'.$movie->image);
            }
            
            $get_name_image = $get_image->getClientOriginalName(); // vidu : hinhanh1.jpg
            $name_image = current(explode('.',$get_name_image)); //  no se tach ra thanh [0]=> hinhanh1 [1]=>jpg
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);
        toastr()->success('Cập nhật thành công');

        // sync là đồng bộ
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        //
        if(session()->has('user_id') && session()->get('user_role')==0){

        $movie = Movie::find($id);// xoa phim xan xoa ca hinh anh
        if(file_exists('upload/movie/'.$movie->image))
        {
            unlink('upload/movie/'.$movie->image);
        }
        // $movie->movie_genre()->sync($data['genre']);
        // xoa the loai
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        // xoa tap phim
        Episode::whereIn('movie_id',[$movie->id])->delete();
        // xoa nhung tap phim co id phim nam trong $id
        
        // xoa phim trong danh sach phim yeu thich cua user
        User_Movie::whereIn('movie_id',[$movie->id])->delete();
        

        $movie->delete();
        toastr()->success('xóa thành công');

        return redirect()->back();
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
