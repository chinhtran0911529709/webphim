{{-- form cho genre: the loai --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('episode.index') }}" class="btn btn-primary">Danh sach tập phim</a>
            <div class="card">
                
                <div class="card-header">Quản lý tập Phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{ route('episode.store') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <div class="form-group">
                                <label for="movie">Chọn phim</label>
                                <input type="text" name="movie_title" id="" class="form-control" value="{{ $movie->title }}"> 
                            </div>
                            <div class="form-group">
                                <label for="linkphim">link phim</label>
                                <input type="text" name="linkphim" id="linkphim" required  class="form-control" placeholder="Nhập vào đường link của phim">   
                            </div>
                            <div class="form-group">
                                <label for="tap phim">Tập phim</label>
                                
                                <select name="episode" class="form-control" id="">
                                    @for($i = 1; $i <= $movie->sotap ; $i++)
                                        <option value="{{ $i }}">Tập {{ $i }}</option>
                                    @endfor
                                </select>
                                
                            </div>
                            <input type="submit" value="{{ isset($episode_edit) ? 'Cập nhật tập phim' : 'thêm tập phim mới' }}" class="btn btn-success">
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tập</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Ngày cập nhật</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($danhsach_tapphim as $key => $tapphim)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $tapphim->episode }}</td>
                                        <td>{{ $tapphim->linkphim }}</td>
                                        <td>{{ $tapphim->created_at }}</td>
                                        <td>{{ $tapphim->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
