@extends('layouts.app')

@section('content')
<div class="card mb-2">
	<div class="card-header">
		<strong>{{ $discussion->author->name }}</strong>
		<h3 class="text-center">{{ $discussion->title }}</h3>
	</div>

	<div class="card-body">
		{!! $discussion->content !!}
	</div>

	@if ($discussion->getBestReply)
	<div class="card bg-success ml-2 mr-2 mb-4" style="color: white">
		<div class="card-header">
			<div class="row">
				<div class="col-md-2">
					{{ $discussion->getBestReply->owner->name }}
				</div>
				<div class="col-md-10">
					<strong class="float-right" style="border-style: groove;">Best reply</strong>

					{!! $discussion->getBestReply->content !!}
				</div>
			</div>
		</div>
	</div>
	@endif

</div>

{{-- All replies --}}
@foreach ($discussion->replies()->paginate(2) as $reply)
<div class="card mb-2">
	<div class="card-header">
		<div class="row">
			<div class="col-md-2">
				{{ $reply->owner->name }}
			</div>
			<div class="col-md-10">
				@auth
				@if (auth()->user()->id == $discussion->user_id)
				@if ($discussion->reply_id != $reply->id)
				<form action="{{ route('discussion.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="post">
					@csrf
					
					<button type="submit" class="btn btn-success float-right">Mark as best reply</button>
				</form>
				@endif
				@endif
				@endauth

				{!! $reply->content !!}
			</div>
		</div>
	</div>
</div>
@endforeach
{{ $discussion->replies()->paginate(2)->links() }}
{{-- End replies --}}

<div class="card">
	<div class="card-header">
		<h6 class="text-center">Add a reply</h6>
	</div>

	<div class="card-body">
		@auth
		<form action="{{ route('replies.store', $discussion->slug) }}" method="post">
			@csrf
			<div class="form-group">
				<input id="content" type="hidden" name="content">
				<trix-editor input="content"></trix-editor>
			</div>
			<button type="submit" class="btn btn-primary">Reply</button>
		</form>
		@else
		<a href="{{ route('login') }}" class="btn btn-primary">Login to add reply</a>
		@endauth
	</div>

</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
@endsection