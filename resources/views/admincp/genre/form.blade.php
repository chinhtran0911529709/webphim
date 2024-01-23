{{-- form cho genre: the loai --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý thể loại</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{ route(isset($genre) ? 'genre.update' : 'genre.store' , isset($genre) ? $genre->id : '') }}" method="POST">
                            @csrf
                            @if(isset($genre))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" required id="slug" onkeyup="ChangeToSlug()" value="{{ isset($genre) ? $genre->title : '' }}" class="form-control" placeholder="Nhập vào dữ liệu ...">
                                
                            </div>
                            <div class="form-group">
                                <label for="slug">slug</label>
                                <input type="text" name="slug" required id="convert_slug" value="{{ isset($genre) ? $genre->slug : '' }}" class="form-control" placeholder="Nhập vào dữ liệu ...">
                                
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" required cols="30" rows="10" class="form-control" style="resize: none;">{{ isset($genre) ? $genre->description: '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">status</label>
                                
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ isset($genre) && $genre->status == 1 ? 'selected' : '' }}>hiển thị</option>
                                    <option value="0" {{ isset($genre) && $genre->status == 0 ? 'selected' : '' }}>không hiển thị</option>
                                </select>
                            </div>
                            <input type="submit" value="{{ isset($genre) ? 'Sửa thông tin' : 'thêm mới' }}" class="btn btn-success">
                        </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
