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

                        <form action="{{ route(isset($episode_edit) ? 'episode.update' : 'episode.store' , isset($episode_edit) ? $episode_edit->id : '') }}" method="POST" >
                            @csrf
                            @if(isset($episode_edit))
                                @method('PUT')
                                
                            @endif
                            <div class="form-group">
                                <label for="movie">Chọn phim</label>
                                <select name="movie_id" id="" class="form-control select-movie">
                                    <option value="0">--chọn phim</option>
                                    @foreach($list_movie as $key => $movie)
                                        
                                        <option value="{{ $movie->id }}" {{ isset($episode_edit) && $episode_edit->movie_id == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="linkphim">link phim</label>
                                <input type="text" name="linkphim" id="linkphim" value="{{ isset($episode_edit) ? $episode_edit->linkphim : '' }}" class="form-control" required placeholder="Nhập vào đường link của phim">   
                            </div>
                            <div class="form-group">
                                <label for="tap phim">Tập phim</label>
                                @if(isset($episode_edit))
                                    <input type="number" name="episode" id="episode" class="form-control" value="{{ $episode_edit->episode }}" readonly>
                                @else
                                <select name="episode" class="form-control" id="show_movie">
                                    
                                </select>
                                @endif
                            </div>
                            <input type="submit" value="{{ isset($episode_edit) ? 'Cập nhật tập phim' : 'thêm tập phim mới' }}" class="btn btn-success">
                        </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
