<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        //hien thi ra danh sách tập phim
        $list_episode = Episode::with('movie')->orderBy('movie_id','DESC')->get();
        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();

        // return response()->json($list_episode);
        return view('admincp.episode.index',compact('list_episode','soluong_phim','soluong_user'));
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
        //
        if(session()->has('user_id') && session()->get('user_role')==0){

        $list_movie = Movie::orderBy('id','DESC')->get();
        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();

        return view('admincp.episode.form',compact('list_movie','soluong_phim','soluong_user'));
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
        //
        $data = $request->all();
        $ep = new Episode();
        $ep->movie_id = $data['movie_id'];
        $ep->linkphim = $data['linkphim'];
           
        $ep->episode = $data['episode'];
        $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep-> updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        toastr()->success('Thêm mới thành công');
        return redirect()->back(); // trở về trang trước đó
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
    public function edit( $id)
    {
        //
        if(session()->has('user_id') && session()->get('user_role')==0){

        $episode_edit = Episode::find($id);
        $list_movie = Movie::orderBy('id','DESC')->get();

        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();


        return view('admincp.episode.form',compact('episode_edit','list_movie','soluong_phim','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }
    }
    public function create_movie_episode_by_id($id){
        // co id movie
        if(session()->has('user_id') && session()->get('user_role')==0){

        $movie = Movie::where('id',$id)->first();// get movie
        // get episode movie
        $danhsach_tapphim = Episode::where('movie_id',$movie->id)->get();
        $soluong_phim=Movie::count();
        $soluong_user  = User::where('role',1)->count();

        
        return view('admincp.episode.form_add_by_id',compact('movie','danhsach_tapphim','soluong_phim','soluong_user'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        // dd($data);
        $ep = Episode::where('id',$id)->first();
        $ep->movie_id = $data['movie_id'];
        $ep->linkphim = $data['linkphim'];       
        $ep->episode = $data['episode'];
        $ep-> updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        toastr()->success('Cập nhật thành công');

        return redirect()->to('episode'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if(session()->has('user_id') && session()->get('user_role')==0){

        //
        $episode = Episode::find($id)->delete();
        toastr()->success('xóa thành công');

        return redirect()->to('episode'); 
        }
        else
        {
            return redirect()->route('login');
        }

    }
    public function select_movie(){
        $id = $_GET['id'];
        $movie = Movie::find($id);
        // echo $movie->sotap;
        $output='<option value="">Chọn tập phim</option>';

        for($i =1 ; $i<=$movie->sotap;$i++)
        {
            $output.='<option value="'.$i.'">tập '.$i.'</option>';
        }
        echo $output;
    }
}
