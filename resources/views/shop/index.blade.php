@extends('layouts.master')

@section('content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('assets/img/contact-bg.jpg')}}')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="page-heading">
					<h1>Shop</h1>
					<span class="subheading">Super cool t-shirts</span>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    @foreach($products as $product)
      <div class="post-preview">
        <a href="{{route('shop.singleProduct', $product->id)}}">
          <h2 class="">
            {{$product->title}}
          </h2>
        </a>
        <p class="post-meta">Posted by
          on {{date_format($product->created_at, 'F d, Y')}}

        </p>
      </div>
      <hr>
    @endforeach
    </div>
  </div>
</div>

@endsection
