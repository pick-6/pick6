<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Charity;

class CharitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index']]);
    }


    public function index(Request $request)
    {
        if (isset($request->search) && $request->search != " ") {
            $charities = Charity::select('charities.*')->where('name', 'like', "%$request->search%")->paginate(15)->appends(['search'=>$request->search]);
        } else {
            $charities = Charity::orderBy('name')->paginate(15);
        }
        $data = [];
        $data['search'] = $request->search;
        $data['count'] = count($charities);
        $data['charities'] = $charities;
        return view('charities')->with($data);
    }


    public function create(Request $request)
    {
        abort(404);
    }


    public function store(Request $request)
    {
        abort(404);
    }


    public function show($id)
    {
        abort(404);
    }


    public function edit($id)
    {
        abort(404); 
    }


    public function update(Request $request, $id)
    {
        abort(404);
    }


    public function destroy($id)
    {
        abort(404);
    }
}
