@extends('layouts.blog')

@section('title', '| Category')

@section('content')

	<h1>{{$category->name}}</h1>
	<ul>
		@foreach($category->articles as $article)
		<li>
			<a href="{{ URL::to('posts/' . $article->id)  }}">{{ $article->title }}</a>
		</li>
		@endforeach
	</ul>

	<nav>
	  <ul class="pager">
		<li><a href="{{ URL::to('cats/') }}">All Categories</a></li>
	  </ul>
	</nav>


@endsection
