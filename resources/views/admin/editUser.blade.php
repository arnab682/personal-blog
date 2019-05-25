@extends('layouts.admin')

@section('title') User @endsection

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    All User
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>Comment</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td class="text-nowrap">{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->posts->count()}}</td>
                                <td>{{$user->comments->count()}}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                                <td>
                                  <a href="#" class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                                  <form id="deleteUser-{{$user->id}}" action="#" method="post">@csrf</form>
                                  <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteUser-{{$user->id}}').submit()">X</button></td>
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
