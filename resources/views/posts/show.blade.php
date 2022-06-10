@extends('layouts.app')

@section('content')
    <div class="container view-image">
        <div class="row">
            <div class="col-8">
                <img src="/images/{{ $post->image }}" alt="" class="w-100">

            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pe-3">
                            <img src="{{ $post->user->profile->profileImage() }}" alt=""
                                class="rounded-circle img-fluid w-100" style="max-width: 40px">
                        </div>
                        <div>
                            <div class="fw-bold text-dark">
                                <a href="/profile/{{ $post->user->id }}" style="text-decoration: none"
                                    class="pe-2">
                                    <span class="text-dark"> {{ $post->user->username }} </span>
                                </a>&bull;
                                <a href="#" class="ps-2" style="text-decoration: none"> Follow</a>
                            </div>
                        </div>


                    </div>
                </div>
                <hr>
                <p><span class="fw-bold text-dark">
                        <a href="/profile/{{ $post->user->id }}" style="text-decoration: none">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>

                    </span>
                    {{ $post->caption }}
                </p>

            </div>
        </div>
    </div>
@endsection
