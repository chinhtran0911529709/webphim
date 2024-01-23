<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[IndexController::class,'home'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class,'category'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class,'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class,'country'])->name('country');
Route::get('/phim/{slug}',[IndexController::class,'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}',[IndexController::class,'watch'])->name('watch');
Route::get('/so-tap',[IndexController::class,'episode'])->name('so-tap');
Route::get('/year-movie/{year}',[IndexController::class,'year_movie'])->name('year-movie');
Route::get('/tag-movie/{tag}',[IndexController::class,'tag_movie'])->name('tag-movie');
Route::get('/tim-kiem',[IndexController::class,'tim_kiem'])->name('tim-kiem');
Route::get('/loc-phim',[IndexController::class,'loc_phim'])->name('loc-phim');
Route::get('/add-phimyeuthich/{movie_id}',[IndexController::class,'add_phimyeuthich'])->name('add-phimyeuthich');
Route::get('/delete-phimyeuthich/{movie_id}',[IndexController::class,'delete_phimyeuthich'])->name('delete-phimyeuthich');
Route::get('/phim-yeu-thich',[IndexController::class,'hienthi_phimyeuthich'])->name('phim-yeu-thich');
// dang nhap
Route::get('/login',[IndexController::class,'login_user'])->name('login');
Route::post('/login',[IndexController::class,'xuly_login']);
// dang ky
Route::get('/dang-ky',[IndexController::class,'dang_ky'])->name('dang-ky');
Route::post('/dang-ky',[IndexController::class,'xuly_dang_ky']);
// doi mat khau
Route::get('/doi-mat-khau',[IndexController::class,'doi_mat_khau'])->name('doi-mat-khau');
Route::post('/doi-mat-khau',[IndexController::class,'xuly_doi_mat_khau']);
// quen mat khau
Route::get('/quen-mat-khau',[IndexController::class,'quen_mat_khau'])->name('quen-mat-khau');
Route::post('/quen-mat-khau',[IndexController::class,'xuly_quen_mat_khau']);
// dang xuat
Route::get('log_out',[IndexController::class,'log_out'])->name('log_out');
// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('category',CategoryController::class);
Route::resource('genre',GenreController::class);
Route::resource('country',CountryController::class);
Route::resource('user',UserController::class);
// them tap phim
Route::resource('episode',EpisodeController::class);


Route::get('episode-select',[EpisodeController::class,'select_movie'])->name('select-movie');
Route::get('create_movie_episode_by_id/{id}',[EpisodeController::class,'create_movie_episode_by_id'])->name('create_movie_episode_by_id');

Route::resource('movie',MovieController::class);
// update năm phim trong index movie admin
Route::get('/update-year-phim',[MovieController::class,'update_year']);
// update top view trong index movie admin
Route::get('/update-topview-phim',[MovieController::class,'update_topview']);
// filter top view này là top view ngày tháng năm trong trang index của người dùng
Route::get('/filter-topview-phim',[MovieController::class,'filter_topview']);
Route::get('/filter-topview-default',[MovieController::class,'filter_default']);





