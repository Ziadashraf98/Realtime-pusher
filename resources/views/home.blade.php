@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @foreach ($posts as $post)
                    <form method="POST" action="{{route('comment.save')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <p><h1>{{$post->title}} @if(Auth::id() == $post->user_id) {{Auth::user()->name}} @endif</h1></p>
                        <p><h6>{{$post->content}}</h6></p>
                        <h5 style="color:blue">Comments</h5>
                        @foreach ($post->comments as $comment)
                            <p style="color: red">{{$comment->comment}}</p>
                        @endforeach
                        {{-- @if(Auth::id() != $post->user_id) --}}
                        <input type="text" class="form-control" name="post_content">
                        {{-- @endif --}}
                        <input type="hidden" value="{{$post->id}}" class="form-control" name="post_id">
                        <br>
                        {{-- @if(Auth::id() != $post->user_id) --}}
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                        {{-- @endif --}}
                    </div>
                </form>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection