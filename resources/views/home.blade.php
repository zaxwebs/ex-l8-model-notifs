@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">Your Notifications</div>
                        <div>
                            <a class="btn btn-primary" href="/simulation/like">Simulate Like</a>
                            <a class="btn btn-primary" href="/simulation/comment">Simulate Comment</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <ul class="list-group">
                        @foreach ($notifications as $notification)
                        <li class="list-group-item">
                            <a href="">{{  $notification->models['User']->name }}</a>
                            @if($notification->type === 'App\Notifications\PostLiked')
                            liked the
                            @else
                            commented the
                            @endif
                            <a href="">{{ $notification->models['Post']->title }}</a> post.
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection