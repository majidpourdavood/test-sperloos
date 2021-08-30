@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('update') }}</div>

                <div class="card-body">
                    @include('layouts.flash-message')
                    <form class="form-horizontal "
                          action="{{ route('post.update', [$post->id]) }}" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}


                        <div class=" row one">
                            <label for="title" class="col-12">title </label>
                            <div class="col-12">
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{ old('title', $post->title) }}" placeholder="title ">
                            </div>
                        </div>


                        <div class=" row one">
                            <label for="content" class="col-12">content </label>
                            <div class="col-12">
                    <textarea type="text" name="content" class="form-control" id="content" rows="5"
                              placeholder="content">{{ old('content',$post->content) }}</textarea>
                            </div>
                        </div>


                        <div class=" row one">
                            <label for="image" class="col-12"> image </label>
                            <div class="col-12">
                                <input type="file" name="image" class="form-control" id="image"
                                       value="{{ old('image') }}" placeholder="image ">
                            </div>
                        </div>



                        <div class=" row one">
                            <div class="col-12">

                                <button type="submit" class="btn btn-primary">
                                    update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
