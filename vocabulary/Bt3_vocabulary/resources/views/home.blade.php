<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>

	{{-- bootstrap --}}
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
	<script src="{{asset('bootstrap/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
	
	{{-- jquery confirm --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	{{-- jquery validate --}}
    <script type="text/javascript" src="{{asset('jquery_validate/jquery.validate.min.js')}}"></script>
    
	{{-- icon --}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	{{-- font text --}}
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
	<div class="wrap">
		
		{{-- header --}}
		<form action="" method="post">
			{{csrf_field()}}
		<header>
			<div class="row bg-primary pt-2 pb-2">
				<div class="col-md-2 logo">
					<h2 class="logo-text">KmtQuiz</h2>
				</div>

				<div class="col-md-2 search">

					<div class="input_search">
						<span class="search_content" action={{route('search')}}><i class="fas fa-search" style="font-size: 20px"></i>Search</span>
					</div>
				</div>

				<div class="col-md-2 search">
						<div action="{{route('addVoca')}}" class="create"><i class="far fa-plus-square" style="font-size: 20px;padding-right:5px"></i>Create</div>
						<meta name="csrf-token" content="{{ csrf_token() }}">
				</div>
				
				<div class="col-md-6 pt-2">
				
					<ul class="acount float-right">  {{--  {{$item['name']}} --}}
						<img src="images/Doraemon.png" class="img-fluid logo-acount">
						{{$nameUser}}
						
						<i class="fas fa-sort-down"></i>

						<ul class="acount-dropdown">
							<li id="setting" class="set"><a class="text-icon" href="{{route('setting')}}"><i id="set_rotage" class="fas fa-cog"></i>Setting</a></li>
							<li id="setting"><a class="text-icon" href="{{route('login')}}"><i id="set_rotage" class="fas fa-sign-out-alt"></i>Log out</a></li>
						</ul>

					</ul>

				</div>
	
			</div>

		</header>
		{{-- end header --}}

		{{-- content --}}
		<div class="content">
				
			{{-- title --}}
			<marquee loop="1" style="font-size: 20px">Hello {{$nameUser}} ! Welcome to KmtQuiz</marquee>
			<div class="title-content">
				
				@if(Session::has('editSuccess'))
					<div class="alert alert-success">{{Session::get('editSuccess')}}</div>
				@endif

				@if(Session::has('success_add'))
					<div class="alert alert-success">{{Session::get('success_add')}}</div>
				@endif

				@if(Session::has('success'))
					<div class="alert alert-success">{{Session::get('success')}}</div>
				@endif

				@if(Session::has('error'))
					<div class="alert alert-danger"> {{ Session::get('error') }}</div>
				@endif
				<h2 class="title-content-text">Stay hungry Stay foolish<i class="fas fa-guitar fa-2x"></i></h2>
				<div class="vocabulary">Your vocabulary</div> 

				<div class="total-vocabulary" style="color: black;font-size: 20px">Page: <span style="font-size: 20px;color: blue;
				padding-left:15px"><i> {{$vocabulary->currentPage()}}</i></span></div>
				

				<p class="total-vocabulary">Total:<span style="font-size: 20px;color: blue;
				padding-left:15px"><i> {{$total}}</i></span></p>
			</div>
			{{-- end title --}}
			<div class="container ">

				<table class="table table-content">
				  {{-- <caption>List of vocabularies</caption> --}}
				  <thead>
				    <tr class="bg-warning">
				      
				      <th scope="col">Vocabulary</th>
				      <th scope="col">Example sentence</th>
				      <th scope="col">Meaning</th>
				      <th scope="col">Edit</th>
				      <th scope="col">Delete</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach($vocabulary as $item)
						<tr>
					      <td>{{$item['name']}}</td>
					      <td>{{$item['sentence']}}</td>
					      <td>{{$item['mean']}}</td>
					      <td><a href="{{route('editVoca',$item['id'])}}"><i class="fas fa-pencil-alt fa-lg"></i></a></td>
					      <td><a id="delete" href="{{route('deleteVoca',$item['id'])}}"><i class="far fa-trash-alt fa-lg" style="padding-left: 12px"></i></a></td>
					    </tr>
				  	@endforeach
				    
				  </tbody>
				</table>
				
				{{-- paginate --}}
						<?php 
							$pageCurrent	=$vocabulary->currentPage();
							$pageLast 		=$vocabulary->lastPage();

							if($pageCurrent==$pageLast) $next=$pageCurrent;
							else 	$next=$vocabulary->currentPage()+1; 

							

						?>
					    <div class="pagination pull-left"> {{--pagination:  << <1/3> >> --}}
							<ul>
								<li>
									<a href="{{str_replace('/?','?',$vocabulary->url($pageCurrent-1))}}"> 
										<span class="btn btn-info"> Prev </span>
									</a>
								</li>
								<li>
									<a href="">
									 <span class="btn btn-primary"> <{{$pageCurrent}}/{{$pageLast }} ></span>
									</a>
								</li>
								
								<li>
									<a href="{{ str_replace('/?','?',$vocabulary->url($next)) }} " > 
										<span class="btn btn-info"> Next <span> 
									</a>
								</li>

							</ul>

						</div>
					    {{-- end paginate --}}
				
			</div>
			


		</div>

		{{-- end content --}}
		

		</form>
	
	</div>

	<script type="text/javascript" src="js/home.js"></script>
</body>
</html>