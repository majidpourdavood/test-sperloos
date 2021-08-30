<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class PostController extends Controller
{

    public function create()
    {

        $user = Auth::user();

        if ($user->can('create', Post::class)) {
            return view('panel.post.create');
        } else {
            return back()->withErrors('Not Authorized');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function show(Post $post)
    {
        return view('panel.post.show', compact(['post']));

    }


    public function store(Request $request)
    {

        $user = Auth::user();

        if ($user->can('store', Post::class)) {

            $this->validate($request, [
                'title' => 'required|string|max:199',
                'content' => 'required|string',
                'image' => 'required|mimes:jpeg,bmp,png,jpg',
            ]);

            $post = new Post();
            $post->title = $request->title;
            $post->content = \request('content');


            $originalImage= $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/thumbnail/';
            $originalPath = public_path().'/images/';
            $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
            $thumbnailImage->resize(100,100);
            $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
            $post->thumbnail = time().$originalImage->getClientOriginalName();
            $post->save();

            return redirect()->route('home')->with('success', 'store post.');

        } else {
            return back()->withErrors('Not Authorized');
        }




    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $user = Auth::user();

        if ($user->can('edit', Post::class)) {
            return view('panel.post.edit', compact(['post']));
        } else {
            return back()->withErrors('Not Authorized');
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        if ($user->can('update', Post::class)) {
            $this->validate($request, [
                'title' => 'required|string|max:199',
                'content' => 'required|string',
                'image' => 'mimes:jpeg,bmp,png,jpg',
            ]);

            $post = Post::findOrFail($id);

            $post->title = $request->title;
            $post->content = \request('content');

            $originalImage= $request->file('image');
            if (isset($originalImage)){
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = public_path().'/thumbnail/';
                $originalPath = public_path().'/images/';
                $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                $thumbnailImage->resize(100,100);
                $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
                $post->thumbnail = time().$originalImage->getClientOriginalName();

            }
            $post->update();
            return redirect()->route('home')->with('success', 'update post.');

        } else {
            return back()->withErrors('Not Authorized');
        }




    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $user = Auth::user();
        if ($user->can('delete', Post::class)) {
            $post->delete();
            return back()->with('info', 'delete post.');
        } else {
            return back()->withErrors('Not Authorized');
        }

    }
}
