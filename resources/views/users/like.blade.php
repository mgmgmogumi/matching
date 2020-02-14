@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@foreach ($users as $user)
		<span class="flex-child col-sm-2">
			<a href="{{ url('users/'.$user->id) }}">
				@if(!empty($user->thumbnail))
				<img src="/storage/thumbnails/{{ $user->thumbnail }}" width="150px" height="150px" class="img-thumbnail rounded-circle">
				@else
				<img src="/storage/thumbnails/no_image.png" width="150px" height="150px" class="img-thumbnail rounded-circle">
				@endif
				<p>{{ $user->name }}</p>
			</a>
		</span>
		@endforeach

	</div>
</div>
@endsection