@extends('layouts.app')

@section('content')
<div class="container">
	@if (session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif

	<form action="{{ url('users/'.$user->id) }}" method="post" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="name">Name</label>
			<input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
		</div>

		<div>
			<label for="thumbnail">Thumbnail</label>
			@if(!empty($user->thumbnail))
			<img src="/storage/thumbnails/{{ $user->thumbnail  }}" width="100px" height="100px" class="thumbnail">
			@endif
			<input id="thumbnail" type="file" name="thumbnail">
		</div>

		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection