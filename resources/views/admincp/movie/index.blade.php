@extends('layouts.app')

@section('content')

<div class="table-responsive">
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">Từ khóa</th>
        <th scope="col">image</th>
        <th scope="col">Số tập phim</th>
        <th scope="col">slug</th>
        <th scope="col">Name Eng</th>
        <th scope="col">decription</th>
        <th scope="col">Trailer</th>
        <th scope="col">Thời lượng</th>
        <th scope="col">Phim hot</th>
        <td scope="col">Định dạng</td>
        <td scope="col">Phụ Đề</td>
        <th scope="col">Active/Inactive</th>
        <th scope="col">Category</th>
        <th scope="col">Genre</th>
        <th scope="col">Country</th>
        <th scope="col">Ngày tạo</th>
        <th scope="col">Ngày cập nhật</th>
        <th scope="col">Năm Phim</th>
        <th scope="col">Session</th>
        <th scope="col">Top view</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $movie)
        <tr>
            <th scope="row">{{ $key }}</th>
            <td>{{ $movie->title }}</td>
            <td>
                {{-- {{ $movie->tags }} --}}
                @if($movie->tags != null)
                {{ substr($movie->tags,0,50) }}...
                @else
                chưa có từ khóa
                @endif
            </td>
            <td><img width="100%" src="{{ asset('upload/movie/'.$movie->image) }}" alt=""></td>
            <td>{{ $movie->episode_count }}/{{ $movie->sotap }} Tập @if($movie->episode_count < $movie->sotap) <br> <a href="{{ url('create_movie_episode_by_id/'.$movie->id.'') }}">Thêm tập phim</a> @endif</td>
            {{-- cái $movie->episode_count là do bên MovieController đã dùng withCount nên thêm hậu tố count : số đến --}}
            <td>{{ $movie->slug }}</td>
            <td>{{ $movie->name_eng }}</td>
            <td>{{substr($movie->description,0,50)}}...</td>
            <td>{{ $movie->trailer }}</td>
            <td>{{ $movie->thoiluong }}</td>
            <td>
                @if($movie->phim_hot == 1)
                Phim hot
                @else
                Không hot
                @endif
            </td>
            <td>
                @if($movie->resolution==0)
                HD
                @elseif($movie->resolution==1)
                SD
                @elseif($movie->resolution==2)
                HDCam
                @elseif($movie->resolution==3)
                FullHD
                @endif
            </td>
            <td>
                @if($movie->phude==0)
                Vietsub
                @else
                Thuyết minh
                @endif
            </td>
            <td>
                @if ($movie->status)
                    Hiển thị
                @else
                    Không hiển thị
                @endif
            </td>
            <td>
                {{-- category
                @foreach($list_category as $key => $cate)
                @if($cate->id == $movie->category_id)
                {{ $cate->title }}
                @endif

                @endforeach --}}
                {{-- thay vì viết như trên , trong moviecontroller đã sử dụng list with mà dữ liệu trong width là các hàm nằm trong model movie --}}
                @if($movie->category != null)

                {{ $movie->category->title }}
                @endif
            </td>
            <td>
                {{-- genre --}}
                {{-- @foreach($list_genre as $key => $genre)
                @if($genre->id == $movie->genre_id)
                {{ $genre->title }}
                @endif

                @endforeach --}}
                @foreach ($movie->movie_genre as $key => $mov)
                    <span class="badge badge-dark">{{ $mov->title }}</span>
                @endforeach
            </td>
            <td>
                {{-- category --}}
                {{-- @foreach($list_country as $key => $country)
                @if($country->id == $movie->country_id)
                {{ $country->title }}
                @endif

                @endforeach --}}
                @if($movie->country != null)
                {{ $movie->country->title }}
                @endif 
            </td>
            
            <td>{{ $movie->ngaytao }}</td>
            <td>{{ $movie->ngaycapnhat }}</td>
            <td>
                <select name="year" id="{{ $movie->id }}" class="select-year">
                    
                    @for($year = 2000 ; $year <=$year_now ; $year++)
                    <option value="{{ $year }}" {{ isset($movie->year) && $movie->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </td>
            <td>
                @if($movie->session != 0)
                {{ $movie->session }}
                @else
                Không có session
                @endif
            </td>
            <td>
                <select name="topview" id="{{ $movie->id }}" class="select-topview">
                    <option {{ $movie->topview == 0 ? 'selected' : '' }} value="0">ngày</option>
                    <option value="1" {{ $movie->topview == 1 ? 'selected' : '' }}>tuần</option>
                    <option value="2" {{ $movie->topview == 2 ? 'selected' : '' }}>tháng</option>
                    <option value="3" {{ $movie->topview == 3 ? 'selected' : '' }}>không</option>
                </select>
            </td>
            <td>
                {{-- <a href="{{ route('genre.destroy',$cate->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</a> --}}
                {{-- <form id="delete-form-{{ $cate->id }}" action="{{ route('genre.destroy', $cate->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form> --}}
                <div style="display: flex;">
                    <form action="{{ route('movie.destroy',$movie->id) }}" method="POST" onclick="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Xóa" class="btn btn-danger">
                    </form>
                    <a href="{{ route('movie.edit',$movie->id) }}" class="btn btn-warning" style="margin-left: 5px">Sửa</a>
                </td>
                </div>
                
          </tr>
        @endforeach
      
      
    </tbody>
</table>
</div>
@endsection