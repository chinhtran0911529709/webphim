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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    //
    public function login_user(){
        
        return view('login.login');
    }
    public function xuly_login(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];
        $user = User::Where('email',$email)->where('password',$password)->first();

        // dd($user);
        if($user!= null)
        {
            session()->put('user_id',$user->id);
            session()->put('user_name',$user->name);
            session()->put('user_email',$user->email);
            session()->put('user_password',$user->password);
            if($user->role == 0)
            {
                // = 0 là admin
                session()->put('user_role',$user->role);
                $soluong_phim = Movie::count();
                $soluong_user  = User::where('role',1)->count();
                // vào trang admin
                toastr()->success('đăng nhập thành công');
                return view('home',compact('soluong_phim','soluong_user'));
            }
            else
            {
                session()->put('user_role',1);
                toastr()->success('đăng nhập thành công');

                return $this->home();
            }
        }
        else
        {
            // session()->put('error_login',"sai tài khoản hoặc mật khẩu");
            toastr()->error('sai tài khoản hoặc mật khẩu');
            return redirect()->back();
        }
    }
    public function dang_ky(){
        return view('login.dangky');
    }
    public function xuly_dang_ky(Request $request){
        $data = $request->all();
        $user_name = $data['user_name'];
        $email = $data['user_email'];
        $password_1 = $data['user_password1'];
        $password_2 = $data['user_password2'];
        if(trim($user_name) == "" || trim($email) == "" || trim($password_1) == "" || trim($password_2) == "")
        {
            toastr()->warning('vui lòng nhập chính xác thông tin');
            return redirect()->back();

        }
        // kiểm tra xem email này đã đc đăng ký chưa
        $user_test = User::where('email',$email)->first();
        
        if($user_test != null)
        {
            // nếu email đã đc đăng ký
            toastr()->warning('Email này đã được đăng ký bởi người khác');

            return redirect()->back();
        }
        if($password_1 != $password_2)
        {
            // yêu cầu nhập lại mật khẩu
            toastr()->warning('mật khẩu mới và mật khẩu nhập lại phải giống nhau');

            return redirect()->back();

        }

        // đăng ký : 
        $user_dk = new User();
        $user_dk->name = $user_name;
        $user_dk->email = $email;
        $user_dk->password = $password_1;
        $user_dk->role = 1;
        $user_dk->save();
        toastr()->success('Đăng ký tài khoản thành công');
        return redirect()->route('login');
    }
    public function doi_mat_khau(){
        // hiển thị form đổi mk:
            if(session()->has('user_id')){
                // nếu user đã đăng nhập :
                return view('login.doimatkhau');
            }
            else
            {
                return redirect()->route('login');
            }
    }
    public function xuly_doi_mat_khau(Request $request){
        $data = $request->all();
        // dd($data);
        if(session()->has('user_id')){
            // nếu user đã đăng nhập :
            $user_id = session()->get('user_id');
            $user_password = session()->get('user_password');
            // neu ng dung nhap sai mk , yeu cau nhajp lai
            if($user_password != $data['password_cu'])
            {
                // mật khẩu nhập vào khác mk trên server => quay trở lại trang đổi mk
            toastr()->warning('Mật khẩu của bạn không chính xác');

                return redirect()->back();
            }
            else
            {
                // nếu mk nhập vào là đúng
                if($data['password_moi'] == $data['password_moi2'] && trim($data['password_moi']) != "")
                {
                    // nếu password nhập lại cũng đúng và khác ""
                    $user = User::where('id',$user_id)->first();
                    $user->password = $data['password_moi'];
                    $user->remember_token = $data['_token'];
                    
                    $user->save();
                    // sau khi save xong, save vao session
                    session()->put('user_password',$data['password_moi']);
                    toastr()->success('đổi mật khẩu thành công');
                    return redirect()->back();
                }
                else
                {
                    return redirect()->back();
                }
            }
            
        }
    }
    public function quen_mat_khau(){
        return view("login.quenmatkhau");
    }
    public function xuly_quen_mat_khau(Request $request){
        $data = $request->all();
        $email_nhan = $data['user_email'];
        
        $user = User::where('email',$email_nhan)->first();
        $user_nhan="";
        $noidung_nhan="";
        if($user != null)
        {
            $user_nhan = $user->name;
            $noidung_nhan = $user->password;
        }
        
        // send mail:
        Mail::send('email.sendmail',compact('user_nhan','noidung_nhan'),function($message) use($email_nhan){
            $message->to($email_nhan,$email_nhan);
            $message->subject('Mật khẩu web phim');
        });
        toastr()->success('mật khẩu của bạn đã được chuyển vào gmail. vui lòng kiểm tra gmail của bạn');
        return redirect()->back();
        
        
    }

    public function log_out(){
        $admin = session()->get('role');
        session()->forget('user_id');
        session()->forget('user_name');
        session()->forget('user_email');
        session()->forget('user_password');
        session()->forget('user_role');
        if($admin == 1)
        {
        return redirect()->back();

        }
        else{
            return redirect()->route('login');
        }
    }
    public function home(){//trang home
        $phimhot = Movie::withCount('episode')->orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        // nested trong laravel
        $category_home = Category::with(['movie'=>function($q){ $q->withCount('episode') ;}])->orderBy('id','DESC')->where('status',1)->get();
        // cái $q là movie với cái episode
        $year_now = Carbon::now()->year;

        return view('pages.home',compact('category','genre','country','category_home','phimhot','year_now','phimhot_sidebar'));
    }
    public function category($slug){//trang category
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        // lấy 1 category theo slug và trả về
        $category_slug = Category::where('slug',$slug)->first();
        // lấy cái danh mục đầu tiên
        // sau khi lấy category_slug, lấy hét phim thuộc category này
        $year_now = Carbon::now()->year;
        $movie = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->where('category_id',$category_slug->id)->paginate(5);
        return view('pages.category',compact('category','genre','country','category_slug','movie','year_now','phimhot_sidebar'));
    }    
    public function year_movie($year){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $year_now = Carbon::now()->year;
        $year = $year;
        $movie = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->where('year',$year)->where('status',1)->paginate(20);
        return view('pages.year',compact('category','genre','country','year_now','movie','year','phimhot_sidebar'));
    }
    public function tag_movie($tag){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $tag = $tag;
        $year_now = Carbon::now()->year;

        // dd($tag);
        $movie = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->where('tags','LIKE','%'.$tag.'%')->where('status',1)->paginate(40);
        return view('pages.tag',compact('category','genre','country','movie','tag','year_now','phimhot_sidebar'));
    }
    public function genre($slug){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->where('phim_hot',1)->where('status',1)->take('20')->get();

        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $genre_slug = Genre::where('slug',$slug)->first();
        // nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id',$genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi )
        {
            $many_genre[] = $movi->movie_id;
        }
        // return response()->json($many_genre);
        $movie = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->whereIn('id',$many_genre)->paginate(40);
        $year_now = Carbon::now()->year;
        return view('pages.genre',compact('category','genre','country','genre_slug','movie','year_now','phimhot_sidebar'));
    }    
    public function country($slug){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $country_slug = Country::where('slug',$slug)->first();
        $movie = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->where('country_id',$country_slug->id)->paginate(40);
        $year_now = Carbon::now()->year;
        return view('pages.country',compact('category','genre','country','country_slug','movie','year_now','phimhot_sidebar'));
    }    
    public function movie($slug){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();
        
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $movie = Movie::with('category','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        $movie_related = Movie::with('category','country','movie_genre')->whereIn('country_id',[$movie->country->id])->whereNotIn('slug',[$slug])->inRandomOrder()->get();
        //->whereIn('category_id',[$movie->category->id])
        // dd($movie_related);
        // $movie_related = Movie::with('category','country','genre')->where('category_id',$movie->category->id)->where('genre_id',$movie->genre->id)->where('country_id',$movie->country->id)->whereNotIn('slug',[$slug])->inRandomOrder()->get();

        $year_now = Carbon::now()->year;
        // lấy ra tập phim dau tien
        $episode_tapdau = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();
        // lay ra 3 tap phim moi
        $episode = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','DESC')->get();
        $episode_count = $episode->count();
        // kiểm tra xem đã đăng nhập hay chưa
        $thichphim = 0;
        if(session()->has('user_id'))
        {
            // đã đăng nhập
            $user_id = session()->get('user_id');
            // lấy đc user_id
            // kiểm tra xem phim này có trong danh sách thích hay không
            $user_movie = User_Movie::where('movie_id',$movie->id)->where('user_id',$user_id)->first();
            if($user_movie != null)
            {
                // tức là có trong danh sách phim yêu thích
                $thichphim =1;
            }
            else{
                $thichphim = 0;
            }
        }
        return view('pages.movie',compact('category','genre','country','movie','movie_related','year_now','phimhot_sidebar','episode','episode_tapdau','episode_count','thichphim'));
    }    
    public function watch($slug,$tap){
        $tap = $tap;
        $tapphim = substr($tap,4,5);
        // dd($tapphim);
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $year_now = Carbon::now()->year;
        $movie = Movie::with('category','country','movie_genre','episode')->where('slug',$slug)->where('status',1)->first();
        // movie_related : phim co the ban muon xem
        $movie_related = Movie::with('category','country','movie_genre')->orwhereIn('category_id',[$movie->category->id])->orwhereIn('country_id',[$movie->country->id])->whereNotIn('slug',[$slug])->inRandomOrder()->get();
        // return response()->json($movie);
        $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        return view('pages.watch',compact('category','genre','country','year_now','movie','movie_related','episode','tapphim'));

    }    
    public function episode(){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $year_now = Carbon::now()->year;
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

        return view('pages.episode',compact('category','genre','country','year_now','phimhot_sidebar'));
        // echo 'chinh123';
    }
    public function tim_kiem(){
        if(isset($_GET['search']))
        {
            $search = $_GET['search'];
            $category =  Category::orderBy('id','DESC')->where('status',1)->get();
            $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            
            $year_now = Carbon::now()->year;
            $movie = Movie::orderBy('ngaycapnhat','DESC')->where('title','LIKE','%'.$search.'%')->paginate(40);
            return view('pages.timkiem',compact('category','genre','country','movie','year_now','phimhot_sidebar','search'));
                
        }
        else{
            return redirect()->to('/');
        }

    }
    public function loc_phim(Request $request){
        $category =  Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $year_now = Carbon::now()->year;

        $data = $request->all();
        $sapxep = $data['order'];
        $genre_id = $data['genre'];
        $category_id = $data['category'];
        $country_id = $data['country'];
        $year = intval($data['year']);
        if( $sapxep == 0 && $category_id == 0 && $genre_id == 0 && $country_id == 0 && $year == 0)
        {
            return redirect()->back();
        }
        else{
            $q = 'select * from movies where ';
            if($category_id !=0)
            {
                $q = $q.'category_id = '.$category_id;
            }
            if($country_id !=0){
                if($category_id !=0){
                    $q=$q.' and ';
                }
                $q=$q.'country_id = '.$country_id;
            }
            if($year !=0){
                if($category_id !=0 || $country_id !=0)
                {
                    $q=$q.' and ';
                }
                $q=$q.'year = '.$year;
            }
            if($genre_id != 0){
                if($category_id !=0 || $country_id != 0 || $year != 0)
                {
                    $q=$q.' and ';
                }
                $q = $q.' id in (select movie_id from movie_genre where genre_id = '.$genre_id.')';
            }
            // đã tìm đc $q rồi
            $id_filter_movie = DB::select($q);
            $movie_id[]='';
            foreach($id_filter_movie as $movie_filter)
            {
                $movie_id[] = $movie_filter->id; 
            }
            // lay dc danh sach movie roi , bay h lay movie nhu binh thg
            $movie='';
            
                $sx='';
                if($sapxep == 1)
                {
                    // sx theo ngay dang
                    $sx='ngaytao';
                }
                else if($sapxep==2)
                {
                    $sx='year';
                }
                else if($sapxep==3)
                {
                    $sx='title';
                }
                else{
                    $sx='id';
                }
            $movie = Movie::orderBy('ngaycapnhat','DESC')->with('movie_genre','country','category')->withCount('episode')->whereIn('id',$movie_id)->orderBy($sx,'ASC')->paginate(5);
            // dd($movie);

            return view('pages.locphim_movie',compact('movie','category','phimhot_sidebar','genre','country','year_now','sapxep','category_id','genre_id','country_id','year'));
            
            // return response()->json($movie);
            // da lay ra duoc phim can tim

            
        }
        
        
    }
    // xu ly phim yeu thich
    public function hienthi_phimyeuthich(){
        if(session()->has('user_id')){
            // neu user da dang nhap
            //lay ra thoong tin phim yeu thich
            $user_id = session()->get('user_id');
            $user_movie = User_Movie::where('user_id',$user_id)->get();
            // dd($user_movie);
            // lay dc danh sach phim
            $movie_id = [] ;
            foreach($user_movie as $movie1)
            {
                $movie_id[] = $movie1->movie_id;
            }
            // dd($movie_id);
            // $movie_yeuthich = Movie::whereIn('id',$movie_id)->get();
            // chua xong
            // dd($movie_yeuthich);
            // hien thi ra phim yeu thich
            $category =  Category::orderBy('id','DESC')->where('status',1)->get();
            $phimhot_sidebar = Movie::orderBy('ngaycapnhat','DESC')->where('phim_hot',1)->where('status',1)->take('20')->get();

            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            // phim yeu thich : movie
            $movie = Movie::orderBy('ngaycapnhat','DESC')->withCount('episode')->whereIn('id',$movie_id)->paginate(40);
            $year_now = Carbon::now()->year;
            return view('pages.user_movie',compact('category','phimhot_sidebar','genre','country','movie','year_now'));

        }
        else
        {
            return redirect()->route('login');
        }
    }
    // them phim yeu thich
    public function add_phimyeuthich($movie_id){
        if(session()->has('user_id')){
            // neu da dang nhap thi add
            $user_movie = new User_Movie();
            $user_movie->user_id = session()->get('user_id');
            $user_movie->movie_id = $movie_id;
            $user_movie->save();
            toastr()->success('Thêm phim yêu thích thành công');
            return redirect()->back();
        }
        else
        {
            // neu chua dang nhap thi quay lai trang login
            toastr()->warning("Bạn phải đăng nhập mới có thể thích phim");
            return redirect()->route('login');
        }
    }
    // xoa phim yeu thich
    public function delete_phimyeuthich($movie_id){
        if(session()->has('user_id')){
            $user_id = session()->get('user_id');
            $user_movie = User_Movie::where('movie_id',$movie_id)->where('user_id',$user_id)->first();// lay ra id
            $user_movie->delete();
            return redirect()->back();
        }
        else
        {
            // neu chua dang nhap thi quay lai trang login
            return redirect()->route('login');
        }

    }
    
}
