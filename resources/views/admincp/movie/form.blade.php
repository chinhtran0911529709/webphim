{{-- form cho genre: the loai --}}
@extends('layouts.app')

@section('content')
                <div class="card-header">Quản lý Phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{ route(isset($movie_edit) ? 'movie.update' : 'movie.store' , isset($movie_edit) ? $movie_edit->id : '') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($movie_edit))
                                @method('PUT')
                                
                            @endif
                            <div class="form-group">
                                <label for="title">Tên phim</label>
                                <input type="text" name="title" id="slug" onkeyup="ChangeToSlug()" value="{{ isset($movie_edit) ? $movie_edit->title : '' }}" class="form-control" placeholder="Nhập vào Tên phim" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="convert_slug" required value="{{ isset($movie_edit) ? $movie_edit->slug : '' }}" class="form-control" placeholder="Tên phim sau khi chuyển đổi">
                                
                            </div>
                            <div class="form-group">
                                <label for="name_eng">Tên tiếng anh</label>
                                <input type="text" name="name_eng" id="name_eng" required value="{{ isset($movie_edit) ? $movie_edit->name_eng : '' }}" class="form-control" placeholder="Nhập vào Tên phim Eng">   
                            </div>
                            <div class="form-group">
                                <label for="sotap">Số tập phim</label>
                                <input type="text" name="sotap" id="sotap" required value="{{ isset($movie_edit) ? $movie_edit->sotap : '' }}" class="form-control" placeholder="Nhập vào Số tập phim">
                                
                            </div>
                            <div class="form-group">
                                <label for="trailer">Trailer</label>
                                <input type="text" name="trailer" id="trailer" value="{{ isset($movie_edit) ? $movie_edit->trailer : '' }}" class="form-control" placeholder="Nhập vào đường link trailer của phim">   
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" required cols="30" rows="10" class="form-control" style="resize: none;">{{ isset($movie_edit) ? $movie_edit->description: '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags phim</label>
                                <textarea name="tags" id="tags" cols="30" required rows="10" class="form-control" style="resize: none;">{{ isset($movie_edit) ? $movie_edit->tags: '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="thoiluong">Thời lượng phim</label>
                                <input type="text" name="thoiluong" id="thoiluong" required  value="{{ isset($movie_edit) ? $movie_edit->thoiluong : '' }}" class="form-control" placeholder="Nhập vào thời lượng của phim">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ isset($movie_edit) && $movie_edit->status == 1 ? 'selected' : '' }}>hiển thị</option>
                                    <option value="0" {{ isset($movie_edit) && $movie_edit->status == 0 ? 'selected' : '' }}>không hiển thị</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Seasion</label>
                                <input type="text" name="session" id="session"  value="{{ isset($movie_edit) ? $movie_edit->session : '0' }}" class="form-control" placeholder="Nhập vào thời lượng của phim">
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="">Resolution</label>
                                
                                <select name="resolution" id="" class="form-control">
                                    <option value="0" {{ isset($movie_edit) && $movie_edit->resolution == 0 ? 'selected' : '' }}>HD</option>
                                    <option value="1" {{ isset($movie_edit) && $movie_edit->resolution == 1 ? 'selected' : '' }}>SD</option>
                                    <option value="2" {{ isset($movie_edit) && $movie_edit->resolution == 2 ? 'selected' : '' }}>HDCam</option>
                                    <option value="3" {{ isset($movie_edit) && $movie_edit->resolution == 3 ? 'selected' : '' }}>FullHD</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Phim Hot</label>
                                
                                <select name="phim_hot" id="" class="form-control">
                                    <option value="1" {{ isset($movie_edit) && $movie_edit->status == 1 ? 'selected' : '' }}>có</option>
                                    <option value="0" {{ isset($movie_edit) && $movie_edit->status == 0 ? 'selected' : '' }}>không</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Phụ đề</label>
                                
                                <select name="phude" id="" class="form-control">
                                    <option value="0" {{ isset($movie_edit) && $movie_edit->phude == 0 ? 'selected' : '' }}>Vietsub</option>
                                    <option value="1" {{ isset($movie_edit) && $movie_edit->phude == 1 ? 'selected' : '' }}>Thuyết minh</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục</label>
                                
                                <select name="category_id" id="" class="form-control">
                                    @foreach($list_category as $key => $cate)
                                    <option value="{{ $cate->id }}" {{ isset($movie_edit) && $movie_edit->category_id == $cate->id ? 'selected' : '' }}>{{ $cate->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Thể loại</label>
                                <br>
                                @foreach($list_genre as $key => $genre)
                                    @if(isset($movie_edit))
                                    <input type="checkbox"  name="genre[]" id="" {{ isset($movie_edit_genre) && $movie_edit_genre->contains($genre->id) ?'checked':'' }} value="{{ $genre->id }}">
                                    @else
                                    <input type="checkbox"  name="genre[]" id="" value="{{ $genre->id }}">
                                    @endif
                                    <label for="genre" style="margin-right:10px">{{ $genre->title}} </label>
                                @endforeach
                            {{-- nhieu the loai --}}
                                {{-- <select name="genre_id" id="" class="form-control">
                                    @foreach($list_genre as $key => $genre)
                                    <option value="{{ $genre->id }}" {{ isset($movie_edit) && $movie_edit->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->title }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="form-group">
                                <label for="">Quốc gia</label>
                                
                                <select name="country_id" id="" class="form-control">
                                    @foreach($list_country as $key => $country)
                                    <option value="{{ $country->id }}" {{ isset($movie_edit) && $movie_edit->country_id == $country->id ? 'selected' : '' }}>{{ $country->title }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img">Hình ảnh</label>
                                <input type="file" name="image" class="form-control-file" id="">
                                @if(isset($movie_edit))
                                <br>
                                <img width="10%" src="{{ asset('upload/movie/'.$movie_edit->image) }}" alt="">

                                @endif
                            </div>
                            <input type="submit" value="{{ isset($movie_edit) ? 'Sửa thông tin' : 'thêm mới' }}" class="btn btn-success">
                        </form>
                </div>




@endsection
