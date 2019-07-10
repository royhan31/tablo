@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit News</div>

                <div class="card-body">
                    <form action="{{route('news.update', $news->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input value="{{ $news->title }}" type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                      </div>
                      <div class="form-group">
                          <label for="content">Content</label>
                          <textarea name="content" id="content" class="form-control" cols="30" rows="10" placeholder="Enter content">{{$news->content}}</textarea>
                      </div>
                      <div class="form-group">
                          <label for="title">Description</label>
                          <input value="{{$news->description}}" type="text" name="description" class="form-control" id="title" placeholder="Enter title">
                      </div>
                      <div class="form-group">
                        <img src="{{asset('images/'.$news->image)}}" alt="img" style="height: 10rem;width: auto">    
                        </div>
                      <div class="form-group">
                          <label for="image">Image</label>
                          <input name="image" type="file" class="form-control-file" id="image">
                      </div>
                      <button type="submit" class="btn btn-sm btn-outline-warning">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection