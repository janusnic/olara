@extends('layouts.blog')

@section('title', '| All Categories')

@section('content')
<h1>Categories</h1>
@foreach($categories as $category)
	<h1>{{$category->name}}</h1>
	<ul>
		@foreach($category->articles as $article)
		<li>
			<a href="{{ URL::to('posts/' . $article->id)  }}">{{ $article->title }}</a>
		</li>
		@endforeach
	</ul>
@endforeach


@endsection
