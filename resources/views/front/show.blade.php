@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>{{ $article->title }}</h1>
            <div class="panel panel-default">
                <p class="blog-post-meta">{{ date('M j, Y h:ia', strtotime($article->updated_at)) }} by <a href="#">Janus</a></p>

                <div class="panel-body">
                    {!! $article->content !!}
                    <hr>
                    @if($article->tags->count())
                        <div class="text-center">
                            <small>Tags: </small>
                            @foreach($article->tags as $tag)
                                {!! link_to('posts/tag?tag=' . $tag->id, $tag->name, ['class' => 'btn btn-default btn-xs']) !!}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
