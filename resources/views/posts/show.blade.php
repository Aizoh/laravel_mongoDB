<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <p><strong>Published Date:</strong> {{ $post->publish_date }}</p>
                    <p>{{ $post->content }}</p>
                    <div>
                        <!-- Add any other post details you want to display -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
