@extends('layouts.adm')

@section('title', '| Edit Blog Post')

@section('stylesheets')

	{!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')

	<div class="row">
		{!! Form::model($post, ['route' => ['blog.update', $post->id], 'method' => 'PUT']) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

			{{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

			{{ Form::label('summary', "Summary:", ['class' => 'form-spacing-top']) }}
			{{ Form::text('summary', null, ['class' => 'form-control']) }}

			{{ Form::label('content', "Content:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('content', null, ['class' => 'form-control']) }}

			{{ Form::label('seo_title', 'Seo Title', ['class' => 'form-spacing-top']) }}
			{{ Form::text('seo_title', null, array('class' => 'form-control')) }}

			{{ Form::label('seo_key', 'Seo seo_key', ['class' => 'form-spacing-top']) }}
			{{ Form::text('seo_key', null, array('class' => 'form-control')) }}

			{{ Form::label('seo_desc', 'Seo seo_desc', ['class' => 'form-spacing-top']) }}
			{{ Form::text('seo_desc', null, array('class' => 'form-control')) }}
		</div>

		<div class="col-md-4">
			<div class="well">
				<div class="row">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
			</div>
				<hr>
				<div class="row">
					<div class="col-sm-6">
					{{ Form::label('seen', 'Seen') }}
					{{ Form::checkbox('seen', 1, null,  array('class' => 'form-control')) }}
				</div>
				<div class="col-sm-6">
					{{ Form::label('active', 'Active') }}
					{{ Form::checkbox('active', 1, null,  array('class' => 'form-control')) }}
				</div>
			</div>

				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('blog.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>

			</div>
		</div>
		{!! Form::close() !!}
	</div>	<!-- end of .row (form) -->

@stop
@section('scripts')
// Select2
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->allRelatedIds()->toArray()) !!}).trigger('change');
	</script>

@endsection
