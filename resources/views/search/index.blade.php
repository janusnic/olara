@extends('layouts.blog')

@section('content')

<div id="app">
            <div class="well well-sm">
                <div class="form-group">
                    <div class="input-group input-group-md">
                        <div class="icon-addon addon-md">
                            <input type="text" placeholder="What are you looking for?" class="form-control" v-model="query">
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" @click="search()" v-if="!loading">Search!</button>
                            <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger" role="alert" v-if="error">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                @{{ error }}
            </div>

             <!-- Item Listing -->

            <div id="items" class="row list-group">
              <div class="blog-post" v-for="item in items">
                <h2 class="blog-post-title">@{{ item.title }}</h2>
                <p>@{{ item.summary }}</p>
                
                <hr>
                <a :href="'{{url('/posts')}}/' + item.slug" class="btn btn-primary">Read more</a>
              </div><!-- /.blog-post -->

            </div>

  </div>

<script src="/js/search.js"></script>
@endsection
