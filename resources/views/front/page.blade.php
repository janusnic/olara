@extends('layouts.blog')

@section('title', '| View Page')

@section('content')

          <div class="blog-post">

            <h2 class="blog-post-title">{{ $content->title }}</h2>
            <p class="blog-post-meta">{{ date('M j, Y h:ia', strtotime($content->updated_at)) }} by <a href="#">Janus</a></p>

			<p>{!! $content->article !!}</p>
            <hr>
          </div><!-- /.blog-post -->

@endsection
