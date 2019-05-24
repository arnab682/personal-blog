@extends('layouts.admin')

@section('title') Auther Post @endsection

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Auther Posts :
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach(Auth::user()->posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td class="text-nowrap"><a href="{{route('singlePost', $post->id)}}">{{$post->title}}</a></td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                <td>{{$post->content}}</td>
                                <td>
                                  <a class="btn-warning" href="{{route('postEdit', $post->id)}}">Edit</a> |
                                <form id="deletePost-{{$post->id}}" action="{{route('deletePost', $post->id)}}" method="post">@csrf</form>
                                  <a href="#" onclick="document.getElementById('deletePost-{{$post->id}}').submit()" class="btn-danger">Remove</a>
                                </td>

                            </tr>
                          @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
