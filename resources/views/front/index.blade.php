@extends('layouts.blog')

@section('content')
<div id="app1">
      <div class="blog-header">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
      </div>

        @foreach ($articles as $key => $article)
          <div class="blog-post">

            <h2 class="blog-post-title">{{ $article->title }}</h2>

            <p class="blog-post-meta">in <a href="{{ URL::to('cats/' . $article->category_id)  }}">{{ $article->category->name }} category</a> {{ date('M j, Y h:ia', strtotime($article->updated_at)) }} by <a href="#">Janus</a></p>

            <p>{{ $article->summary }}</p>
            @if (Auth::check())
                <div class="panel-footer">
                    <favorite
                        :article={{ $article->id }}
                        :favorited={{ $article->favorited() ? 'true' : 'false' }}
                    >
                    </favorite>
                </div>
            @endif
            <hr>
            <a href="{{ route('posts.show', $article->slug) }}" class="btn btn-primary">Read more</a>
          </div><!-- /.blog-post -->
        @endforeach

        <nav>
          <ul class="pager">
              <?php echo $articles->render(); ?>

          </ul>
        </nav>
</div>
@endsection
