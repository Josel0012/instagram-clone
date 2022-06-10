<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        // $user = User::findOrFail($user);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'counts.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );


        return view('profiles.index', compact('user', 'follows', 'postCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }



    public function update(User  $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'url' => 'url',
            'descriptions' => 'required',
            'image' => ''
        ]);

        $image = request()->file('image');

        if (request('image')) {
            $image = request()->file('image');

            $input['imagename'] = time() . '.' . $image->extension();


            $destinationPath = public_path('/storage/profile');

            $img = Image::make($image->path());
            // function ($constraint) {$constraint->aspectRatio();}
            $img->fit(1000, 1000)->save($destinationPath . '/' . $input['imagename']);

            $imgArray = ['image' => $input['imagename']];
        }


        auth()->user()->profile->update(array_merge(
            $data,
            $imgArray ?? [],
        ));
        // dd(array_merge($data, ['image' => $img]));
        return redirect("/profile/{$user->id}");
    }
}
