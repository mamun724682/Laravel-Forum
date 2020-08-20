@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">
		<strong>Notifications</strong>
	</div>
	<div class="card-body">
		<ul class="list-group">
			@foreach ($notifications as $notification)
				<li class="list-group-item">
					@if ($notification->type == 'App\Notifications\AddReplyNotification')
						A new reply was added to 
						<strong>
							{{ $notification->data['discussion']['title'] }}
						</strong>
						<a href="{{ route('discussion.show', $notification->data['discussion']['slug']) }}" class="btn btn-primary btn-sm float-right">View</a>
					@endif
					@if ($notification->type == 'App\Notifications\MarkBestReplyNotification')
						A reply was marked as best  
						<strong>
							{{ $notification->data['discussion']['title'] }}
						</strong>
						<a href="{{ route('discussion.show', $notification->data['discussion']['slug']) }}" class="btn btn-primary btn-sm float-right">View</a>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</div><br>
@endsection