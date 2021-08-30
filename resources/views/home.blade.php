@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @include('layouts.flash-message')


                        <div class="row col-12">


                            @if(isset($posts))

                                @foreach($posts as $post)
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 item">
                                        <div class="card" style="width: 20rem;">
                                            <img class="card-img-top" src="/thumbnail/{{$post->thumbnail}}"
                                                 alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title">{{$post->title}}</h4>
                                                <p class="card-text">{{$post->content}}</p>



                                                <li class="list-inline-item">
                                                    <form action="{{ route('post.destroy'  , [ $post->id]) }}"
                                                          method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn_group ">
                                                            <a href="{{ route('post.edit' , [$post->id]) }}"
                                                               title="edit" class="btn btn-outline-warning">
                                                              edit</a>

                                                            <a href="{{ route('post.show' , [$post->id]) }}"
                                                               title="edit" class="btn btn-outline-warning">
                                                                show</a>

                                                            <button type="submit" class="btn  btn-outline-danger"
                                                                    onclick="return  confirm('are you sure delete post?')">
                                                            delete
                                                            </button>
                                                        </div>
                                                    </form>
                                                </li>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
