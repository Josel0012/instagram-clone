@extends('layouts.app')

@section('content')
    <div class="container view-image">
        <div class="row">
            <div class="col-md-8">
                @foreach ($posts as $post)
                    <div class="">
                        <div class="ps-5 pe-5">
                            <a href="/profile/{{ $post->user->id }}"><img src="/storage/uploads/{{ $post->image }}"
                                    alt="" class="w-100"></a>


                        </div>
                    </div>
                    <div class="pt-2 pb-4">
                        <div class="ps-5 pe-5">
                            <div>
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
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <img class="rounded-circle me-4" src="{{ Auth::user()->profile->profileImage() }}" alt=""
                        style="width:40px">
                    <a href="profile/{{ Auth::user()->id }}">{{ Auth::user()->username }}</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
@endsection
