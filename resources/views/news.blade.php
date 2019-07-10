@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">News</div>

                <div class="card-body">
                    <a href="{{route('news.create')}}" class="btn btn-sm btn-outline-primary" style="margin-bottom: 10px">create</a>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif                    
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $key => $item)
                                <tr>
                                    <th scope="row">{{ ($currentPage-1)*$perPage+$key+1 }}</th>
                                    <td><img src="{{ asset('images/'.$item->image) }}" style="height: 5rem; width: auto" alt="image-news"></td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->content }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td scope="row" style="width: 15%">
                                        <center>
                                            <a href="{{route('news.edit', $item->id)}}" class="btn btn-sm btn-outline-success">edit</a>
                                            <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete{{$item->id}}">delete</a>
                                        </center>
                                        <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger" id="exampleModalLabel">WARNING YOU WILL LOSE THIS RECORD</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('news.destroy', $item->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <p>Are you sure to delete this data?</p>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal">keep</button>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$news->links()}}
                    </div>
                    <div class="d-flex justify-content-center">
                        <p>Showing {{$news->firstItem()}} - {{$news->lastItem()}} of {{$news->total()}} entries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection