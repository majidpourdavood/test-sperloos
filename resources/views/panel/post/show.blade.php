@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{$post->title}}</h1>
                </div>

                <div class="card-body">
                    @include('layouts.flash-message')

                    <img src="/thumbnail/{{$post->thumbnail}}" alt="">


                    <p>{{$post->content}}</p>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
