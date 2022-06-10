<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image;

class PostsController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->orderBy('created_at', 'DESC')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    // public function store()
    // {
    //     $data = request()->validate([
    //         'caption' => 'required',
    //         'image' => 'required|image',
    //     ]);

    //     $imagePath = request('image')->store('uploads', 'public');

    //     $image = Image::make(public_path('storage/{$imagePath}'))->fit(1200, 1200);
    //     $image->save();


    //     auth()->user()->posts()->create([
    //         'caption' => $data['caption'],
    //         'image' => $imagePath,
    //     ]);

    //     return redirect('/profile/' . auth()->user()->id);
    // }

    public function store(Request $request)

    {

        $this->validate($request, [

            'caption' => 'required',
            'image' => 'required|image',

        ]);



        $image = $request->file('image');

        $input['imagename'] = time() . '.' . $image->extension();


        $destinationPath = public_path('/storage/uploads');

        $img = Image::make($image->path());
        // function ($constraint) {$constraint->aspectRatio();}
        $img->fit(500, 500)->save($destinationPath . '/' . $input['imagename']);



        $destinationPath = public_path('/images');

        $image->move($destinationPath, $input['imagename']);

        // $img->save();
        $img_name = $input['imagename'];
        auth()->user()->posts()->create([
            'caption' => $request['caption'],
            'image' => $img_name,
        ]);
        // return back()

        //     ->with('success', 'Image Upload successful')

        //     ->with('imageName', $input['imagename']);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post)
    {
        return view(
            'posts.show',
            compact('post')

        );
    }
}
