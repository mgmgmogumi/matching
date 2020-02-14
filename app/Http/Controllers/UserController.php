<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Like;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authUser = Auth::user();
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $users = User::where('id', '!=', $authUser->id)->where('name', 'like', '%' . $keyword . '%')->get();
        } else {
            $users = User::where('id', '!=', $authUser->id)->get();
        }

        return view('users.index', ['users' => $users, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authUser = Auth::user();

        $user = User::findOrFail($id);
        $like = Like::where('from_user_id', $authUser->id)->where('to_user_id', $id)->get();
        return view('users.show', ['user' => $user, 'like' => $like]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $thumbnailname = $request->file('thumbnail')->hashName();
        $user->thumbnail = $thumbnailname;
        $user->save();

        $request->file('thumbnail')->storeAs('public/thumbnails', $thumbnailname);
        return redirect('users/' . $user->id . '/edit')->with('success', '保存しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function matching()
    {
        $authUser = Auth::user();
        $likes = User::find($authUser->id)->likes;

        $users = [];
        foreach ($likes as $like) {
            $liked = Like::where('from_user_id', $like->to_user_id)->where('to_user_id', $authUser->id)->first();
            if (!empty($liked)) {
                // echo $liked;
                $users[] = $liked->from_user;
            }
        }

        return view('users.like', ['users' => $users]);
    }

    public function liked()
    {
        $authUser = Auth::user();
        $likeds = Like::where('to_user_id', $authUser->id)->get();
        // $likeds = User::find($authUser->id)->likeds;

        $users = [];
        foreach ($likeds as $liked) {
            $users[] = $liked->from_user;
        }

        return view('users.like', ['users' => $users]);
    }

    public function like()
    {
        $authUser = Auth::user();
        $likes = User::find($authUser->id)->likes;

        $users = [];
        foreach ($likes as $like) {
            $users[] = $like->to_user;
        }

        return view('users.like', ['users' => $users]);
    }
}
