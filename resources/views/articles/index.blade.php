@extends('layouts.home')

@section('content')
    <h3 class="page-title">Articles List</h3>
    <p>
        <a href="{{ route('articles.create') }}" class="btn btn-success">Add new</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($articles) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($articles) > 0)
                        @foreach ($articles as $article)
                            <tr data-entry-id="{{ $article->id }}">
                                    <td></td>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->active }}</td>
                                <td>

                                    <a href="{{ route('articles.show',[$article->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    <a href="{{ route('articles.edit',[$article->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['articles.destroy', $article->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
            window.route_mass_crud_entries_destroy = '{{ route('articles.mass_destroy') }}';
    </script>
@endsection
