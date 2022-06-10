@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">

            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit profile</h1>
                    </div>
                    <div class="form-group row ">
                        <label for="title" class="col-md-4 col-form-label ">Title</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ $user->profile->title }}" autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row ">
                        <label for="descriptions" class="col-md-4 col-form-label ">Description</label>
                        <input id="descriptions" type="text"
                            class="form-control @error('descriptions') is-invalid @enderror" name="descriptions"
                            value="{{ $user->profile->descriptions }}" autocomplete="descriptions" autofocus>

                        @error('descriptions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row ">
                        <label for="url" class="col-md-4 col-form-label ">URL</label>
                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                            value="{{ $user->profile->url }}" autocomplete="url" autofocus>

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row ">
                        <label for="image" class="col-md-4 col-form-label ">URL</label>
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            autocomplete="image" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button class="btn btn-primary"> Update Profile</button>
                    </div>
                </div>






            </div>
        </form>
    </div>
@endsection
