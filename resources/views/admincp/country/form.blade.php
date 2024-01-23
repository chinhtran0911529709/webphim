{{-- form cho country --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý Quốc gia</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{ route(isset($country) ? 'country.update' : 'country.store' , isset($country) ? $country->id : '') }}" method="POST">
                            @csrf
                            @if(isset($country))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" required id="slug" onkeyup="ChangeToSlug()" value="{{ isset($country) ? $country->title : '' }}" class="form-control" placeholder="Nhập vào dữ liệu ...">
                                
                            </div>
                            <div class="form-group">
                                <label for="slug">slug</label>
                                <input type="text" name="slug" id="convert_slug" required  value="{{ isset($country) ? $country->slug : '' }}" class="form-control" placeholder="Nhập vào dữ liệu ...">
                                
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" required cols="30" rows="10" class="form-control" style="resize: none;">{{ isset($country) ? $country->description: '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">status</label>
                                
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ isset($country) && $country->status == 1 ? 'selected' : '' }}>hiển thị</option>
                                    <option value="0" {{ isset($country) && $country->status == 0 ? 'selected' : '' }}>không hiển thị</option>
                                </select>
                            </div>
                            <input type="submit" value="{{ isset($country) ? 'Sửa thông tin' : 'thêm mới' }}" class="btn btn-success">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
