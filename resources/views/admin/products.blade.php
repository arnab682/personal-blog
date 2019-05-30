@extends('layouts.admin')

@section('title') author Post @endsection

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Product : <a href="{{route('adminNewProduct')}}" class="btn btn-primary">New Product</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{asset($product->thumbnail)}}" width="100" height=""</td>
                                <td class="text-nowrap"><a href="{{route('adminEditProduct', $product->id)}}">{{$product->title}}</a></td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                  <a href="{{route('adminEditProduct', $product->id)}}" class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                                  |
                                  <form style="display: none;" class="" id="deleteProduct-{{$product->id}}" action="{{route('adminDeleteProduct', $product->id)}}" method="post">
                                  @csrf </form>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal-{{$product->id}}">X</button>
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

@foreach($products as $product)

<!-- Modal -->
<div class="modal fade" id="deleteProductModal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">You are about to delete {{$product->title}}.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure...???
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Keep it.</button>
      <form class="" id="deleteProduct-{{$product->id}}" action="{{route('adminDeleteProduct', $product->id)}}" method="post">
      @csrf
        <button type="submit" class="btn btn-primary">Yes, Delete it.</button></form>
      </div>
    </div>
  </div>
</div>

@endforeach


@endsection
