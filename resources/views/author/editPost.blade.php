@extends('layouts.admin')

@section('title') Edit Post @endsection

@section('content')

<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header bg-light">
                      New Post :
                  </div>
                  @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                  @endif

                  @if($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                  <form class="" action="{{route('postEditPost', $post->id)}}" method="post">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="normal-input" class="form-control-label">Title</label>
                                    <input name="title" class="form-control" value="{{ $post->title }}" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="placeholder-input" class="form-control-label">Content</label>
                                    <textarea name="content" class="form-control" rows="8" cols="80" >{{$post->content}}</textarea>
                                </div>
                            </div>
                        </div>
                    <button class="btn btn-success" type="submit">Edit Post</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>

  </div>
</div>

@endsection
