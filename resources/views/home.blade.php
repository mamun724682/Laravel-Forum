@extends('layouts.app')

@section('content')
@foreach ($discussions as $discussion)
<div class="card">
  <div class="card-header">
    <strong>{{ $discussion->author->name }}</strong>
    <a href="{{ route('discussion.show', $discussion->slug) }}" class="btn btn-primary btn-sm float-right">View</a>
  </div>

    <div class="card-body">
        {{ $discussion->title }}
    </div>
</div><br>
@endforeach

{{ $discussions->links() }}
@endsection