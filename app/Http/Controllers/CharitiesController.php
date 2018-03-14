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
        $searchTerm = trim($request->search);
        $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);
        if (isset($searchTerm)) {
            $charities = Charity::select('charities.*')->where('name', 'like', "%". $searchTerm ."%")->orWhere('website', 'like', "%". $searchTerm ."%")->orWhere('description', 'like', "%". $searchTerm ."%")->orderBy('name')->paginate(40)->appends(['search'=>$searchTerm]);
        } else {
            $charities = Charity::orderBy('name')->paginate(40);
        }
        $data = [];
        $data['search'] = $searchTerm;
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
