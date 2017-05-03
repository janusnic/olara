<h3>Recent Posts</h3>
<ul class="nav nav-pills nav-stacked">
@foreach ($articles as $key => $value)
      <li><a href="{{ route('posts.show', $value->slug) }}">{{ $value->title }}</a></li>
@endforeach
</ul>
