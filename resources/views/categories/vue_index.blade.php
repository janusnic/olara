@extends('layouts.home')

@section('content')
<style>

.full-height {
	min-height: 70vh;
}

.flex-center {
	align-items: center;
	display: flex;
	justify-content: center;
}

.position-ref {
	position: relative;
}

.top-right {
	position: absolute;
	right: 10px;
	top: 18px;
}

.content {
	text-align: center;
}


.m-b-md {
	margin-bottom: 30px;
}
</style>

<div class="flex-center position-ref full-height">
    <div id="vue-wrapper">
        <div class="content">
            <div class="form-group row">
                <div class="col-md-8">
                    <input type="text" class="form-control" id="name" name="name"
                        required v-model="newItem.name" placeholder=" Enter some name">

                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" @click.prevent="createItem()"
                        id="name" name="name">
                        <span class="fa fa-plus"></span> ADD
                    </button>
                </div>
            </div>
            <p class="text-center alert alert-danger"
                v-bind:class="{ hidden: hasError }">Please enter some value!</p>
            {{ csrf_field() }}
            <p class="text-center alert alert-success"
                v-bind:class="{ hidden: hasDeleted }">Deleted Successfully!</p>
            <div class="table table-borderless" id="table">
                <table class="table table-borderless" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tr v-for="item in items">
                        <td>@{{ item.id }}</td>
                        <td>@{{ item.name }}</td>
                        <td @click.prevent="deleteItem(item)" class="btn btn-danger"><span
                            class="fa fa-trash"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection
