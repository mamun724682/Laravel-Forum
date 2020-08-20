@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create Discussion</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('discussion.store') }}" method="post">
            @csrf
            
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <select name="channel" class="form-control" id="">
                  <option selected disabled>Select Channel</option>
                  @foreach ($channels as $channel)
                  <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                  @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
@endsection