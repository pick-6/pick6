<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CharitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $posts = Post::join('user_bets', '', '=', 'user.id')
               ->where('game_id', 'LIKE', )
               ->orWhere('bet_total')
               ->orderBy('game_id', 'ASC')
        } else {
            $posts = Post::orderBy('game_id', 'ASC')->paginate();
        }

        $data = [];
        $data['posts'] = $posts;

        return view('charities.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('charities');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);
        $charities = new Charity();
        $charities->name = $request->name;
        $charities->location = $request->location;
        $charities->category = $request->category;
        $charities->description = $request->description;
        $charities->save();
        Log::info("New charity created", $request->all());
        $request->session()->flash('successMessage', 'Charity saved successfully');
        return redirect()->action('CharitiesController@show', [$post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $charities = Charity::find($id);
        if(!$charities) {
            Log::error("Charity with id of $id not found.");
            abort(404);
        }
        $data = [];
        $data['charities'] = $charities;
        return view('charities.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $charities = Charity::find($id);
        if (!$charities) {
            Log::error("Charity with id of $id not found.");
            abort(404);
        }
        $data = [];
        $data['charities'] = $charities;
        return view('charaties.edit')->with($data);   
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
        $this->validate($request, Charity::$rules);
        $charities = Charity::find($id);
        if (!$charities) {
            Log::error("Charity with id of $id not found.");
            abort(404);
        }
        $charities->name = $request->name;
        $charities->location = $request->location;
        $charities->category = $request->content;
        $charities->description = $request->description;
        $charities->save();
        $request->session()->flash('successMessage', 'Post updated successfully');
        return redirect()->action('CharitiesController@show', [$post->id]);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $charities = Charity::find($id);
        if (!$charities) {
            Log::error("charities with id of $id not found.");
            abort(404);
        }
        $charities->delete();
        $request->session()->flash('successMessage', 'charities deleted successfully');
        return view('charities.index');
    }
}
