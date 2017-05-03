@extends('layouts.blog')

@section('content')
<div id="app">

      <div class="blog-header">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
      </div>

      <!-- Item Listing -->

          <div class="blog-post" v-for="item in items">
            <h2 class="blog-post-title">@{{ item.title }}</h2>
            <p>@{{ item.summary }}</p>
          
            <hr>
            <a href="{{url('/posts/show')}}/"@{{item.slug}} class="btn btn-primary">Read more</a>
          </div><!-- /.blog-post -->

<!-- Pagination -->
      <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="getItems(pagination.current_page)"
                     :offset="4">
        </vue-pagination>
</div>

<script src="/js/front.js"></script>
@endsection
