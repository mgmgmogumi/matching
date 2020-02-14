@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row input-group">
		<div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
			<form class="form-inline" action="{{url('users')}}">
				<input type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="ユーザーを検索">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-secondary">検索</button>
				</span>
			</form>
		</div>
	</div>

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