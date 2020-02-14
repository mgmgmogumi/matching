@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div>
			@if(!empty($user->thumbnail))
			<img src="/storage/thumbnails/{{ $user->thumbnail }}" width="200px" height="200px" class="img-thumbnail rounded-circle">
			@else
			<img src="/storage/thumbnails/no_image.png" width="200px" height="200px" class="img-thumbnail rounded-circle">
			@endif
		</div>
		<div class="d-flex align-items-end">
			@if(count($like)==0)
			<form action="{{ url('likes/'.$user->id) }}" method="post">
				@csrf
				<button type="submit" class="btn btn-outline-primary">いいね</button>
			</form>
			@else
			<form action="{{ url('likes/'.$user->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-primary">いいね</button>
			</form>
			@endif
		</div>
	</div>
	<div class="row">
		<table>
			<tr>
				<td class="col-md-2">Name</th>
				<td class="col-md-10">{{ $user->name }}</th>
			</tr>
			<tr>
				<td class="col-md-2">e-mail</dt>
				<td class="col-md-10">{{ $user->email }}</dd>
			</tr>
		</table>
	</div>
</div>
</dl>
@endsection