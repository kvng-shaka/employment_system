<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use DB;
use App\State;
use App\Country;
use App\City;
use App\Department;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')
        ->leftJoin('cities', 'employees.city_id', '=', 'cities.id')
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        ->leftJoin('states', 'employees.state_id', '=', 'states.id')
        ->leftJoin('countries', 'employees.country_id', '=', 'countries.id')
        ->select('employees.*', 'departments.name as department_name', 'departments.id as department_id')
        ->paginate(10);
        return view('employee.index')->with('employees', $employees);
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
        State::find($request['state_id']);
        Country::find($request['country_id']);
        City::find($request['city_id']);
        Department::find($request['department_id']);
        $validatedData = $request->validate([
            'firstname'          => 'required',
            'lastname'          => 'required',
            'address'          => 'required',
            'country_id'          => 'required',
            'state_id'    => 'required', 
            'city_id'       => 'required',
            'age'       =>   'required',
            'date_of_birth'   => 'required',
            'date_hired' => 'required',
            'department_id'    => 'required',
            'picture' => 'required|nullable|max:1999',
        ]);

        //Handle picture upload
        if($request->hasFile('picture')){
            //Get Filename With the Extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload Image
            $path = $request->file('picture')->storeAs('public/picture', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $emp = new Employee;

        $emp->firstname     = $request->firstname;
        $emp->lastname     = $request->lastname;
        $emp->address       = $request->address;
        $emp->country_id  = $request->country_id;
        $emp->state_id      = $request->state_id;
        $emp->city_id       = $request->city_id;
        $emp->age           = $request->age;
        $emp->date_of_birth  = $request->date_of_birth;
        $emp->date_hired    = $request->date_hired;
        $emp->department_id  = $request->department_id;
        $emp->picture       = $fileNameToStore;

        $emp->save();

        return redirect('/employee')->with('success', 'Employee Created Successfully!');
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
}
