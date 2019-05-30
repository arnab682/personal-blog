@extends('layouts.master')

@section('content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('assets/img/contact-bg.jpg')}}')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="page-heading">
					<h1>{{$product->title}}</h1>

				</div>
			</div>
		</div>
	</div>
</header>

<div class="container">
  <div class="row">
		<div class="col-md-6">
			<img src="{{asset($product->thumbnail)}}" alt="" width="600" height="320">
		</div>
		<div class="col-md-1">

		</div>
		<div class="col-md-5">
			<h2>{{$product->title}}</h2><hr>
			<b>{{$product->price}}</b><hr>
			<p>{{$product->description}}</p><br>
			<a href="{{route('shop.orderProduct')}}" class="btn btn-primary">Check with Paypal</a>
		</div>
	</div>
</div>

@endsection
