@extends('layouts.adm')
@section('content')

    <h1>All Posts</h1>

    @if (Session::has('message'))
       <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
<a href="{{ URL::to('blog/create') }}" class="btn btn-small btn-info">Create a Post</a>
    <table class="table table-striped table-bordered">
       <thead>
           <tr>
               <td>ID</td>
               <td>Title</td>
               <td>Active</td>
               <td>Actions</td>
           </tr>
       </thead>
       <tbody>

       @foreach ($articles as $key => $value)
           <tr>
               <td>{{ $value->id }}</td>
               <td>{{ $value->title }}</td>
               <td>{{ $value->active }}</td>
               <td>

                   {{ Form::open(array('url' => 'blog/' . $value->id, 'class' => 'pull-right')) }}
                       {{ Form::hidden('_method', 'DELETE') }}
                       {{ Form::submit('Delete this Post', array('class' => 'btn btn-warning')) }}
                   {{ Form::close() }}

                   <a class="btn btn-small btn-success" href="{{ URL::to('blog/' . $value->id) }}">Show</a>

                   <a class="btn btn-small btn-info" href="{{ URL::to('blog/' . $value->id . '/edit') }}">Edit</a>

               </td>
           </tr>
       @endforeach
       <nav>
         <ul class="pager">

             {{ $articles->links() }}
         </ul>
       </nav>

       </tbody>
    </table>
@stop
