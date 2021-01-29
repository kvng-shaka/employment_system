<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\City;
use App\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = DB::table('cities')
        ->leftJoin('states', 'cities.state_id', '=', 'states.id')
        ->select('cities.id', 'cities.name', 'states.name as states_name', 'states.id as states_id')
        ->paginate(10);
        //dd($cities);
        return view('system-mgt.city.index')->with('cities', $cities);
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
        State::findOrFail($request['state_id']);
        $validatedData = $request->validate([
            'name'          => 'required',
            'state_id'    => 'required', 
        ]);

        $state = new City;

        $state->name  = $request->name;
        $state->state_id  = $request->state_id;

        $state->save();

        return redirect('/city')->with('success', 'City Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function loadCities($stateId) 
    {
        $cities = City::where('state_id', '=', $stateId)->get(['id', 'name']);

        return response()->json($cities);
    }
}
