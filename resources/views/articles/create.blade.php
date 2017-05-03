@extends('layouts.home')

@section('content')

<h1>Create New Post</h1>

{{ Html::ul($errors->all() )}}

{{ Form::open(array('url' => 'articles')) }}

	<div class="form-group">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
	{{ Form::label('category_id', 'Category:') }}
	<select class="form-control" name="category_id">
		@foreach($categories as $category)
			<option value='{{ $category->id }}'>{{ $category->name }}</option>
		@endforeach

	</select>


	{{ Form::label('tags', 'Tags:') }}
	<select class="form-control select2-multi" name="tags[]" multiple="multiple">
		@foreach($tags as $tag)
			<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
		@endforeach

	</select>
	</div>

	<div class="form-group">
		{{ Form::label('summary', 'Summary') }}
		{{ Form::text('summary', Input::old('summary'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('content', 'Content') }}
		{{ Form::textarea('content', Input::old('content'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('seen', 'Seen') }}
		{{ Form::checkbox('seen', 1, null,  array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('active', 'Active') }}
		{{ Form::checkbox('active', 1, null,  array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('seo_title', 'Seo Title') }}
		{{ Form::text('seo_title', Input::old('seo_title'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('seo_key', 'Seo seo_key') }}
		{{ Form::text('seo_key', Input::old('seo_key'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('seo_desc', 'Seo seo_desc') }}
		{{ Form::text('seo_desc', Input::old('seo_desc'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Create the Article!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
