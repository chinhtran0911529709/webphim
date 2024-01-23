@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table" id="tablephim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">link phim</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list_episode as $key => $episode)
                    <tr>
                        <th scope="row">{{ $key }}</th>
                        <td>{{ $episode->movie->title }}</td>
                        <td><img src="{{ asset('upload/movie/'.$episode->movie->image) }}" alt="" width="100%"></td>
                        <td>{{ $episode->episode }}</td>
                        {{-- <td><iframe width="560" height="315" src="{{ $episode->linkphim }}" title="YouTube video player" frameborder="0" allow="accelerometer ; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></td> --}}
                        <td >{!! $episode->linkphim !!}</td>
                        <td>
                            Hiển thị
                        </td>
                        <td>
                            {{-- <a href="{{ route('category.destroy',$cate->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</a> --}}
                            {{-- <form id="delete-form-{{ $cate->id }}" action="{{ route('category.destroy', $cate->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form> --}}
                            <div style="display: flex;">
                                <form action="{{ route('episode.destroy',$episode->id) }}" method="POST" onclick="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Xóa" class="btn btn-danger">
                                </form>
                                <a href="{{ route('episode.edit',$episode->id) }}" class="btn btn-warning" style="margin-left: 5px">Sửa</a>
                            </td>
                            </div>
                            
                      </tr>
                    
                    @endforeach
                  
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
