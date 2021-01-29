@extends('employee.base')

@section('content')
<?php
    $cities = App\City::all();
    $states = App\State::all();
    $countries = App\Country::all();
    $departments = App\Department::all();
?>
    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-8">
                                <h2 class="box-title">List of employees</h2>
                                </div>
                                <div class="col-sm-4">
                                <a class="btn btn-primary"  href="#" data-toggle="modal" data-target="#add_emp_Modal">Add new employee</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/employee" class="breadcrumb-link">Employee Management</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- ============================================================== -->
                <!-- data table multiselects  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data Tables - Multi item selection </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Employee Name</th>
                                            <th>Address</th>
                                            <th>Department</th>
                                            <th>Date of Birth</th>
                                            <th>Age</th>
                                            <th>Hired date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                        <tr>
                                                <td>{{$employee->picture}}</td>
                                                <td>{{$employee->lastname}} {{$employee->firstname}}</td>
                                                <td>{{$employee->address}}</td>
                                                <td>{{$employee->department_name}}</td>
                                                <td>{{$employee->date_of_birth}}</td>
                                                <td>{{$employee->age}}</td>
                                                <td>{{$employee->date_hired}}</td>
                                                <td>
                                                    <form class="row" method="POST" action="{{ route('employee.destroy', $employee->id) }}" onsubmit = "return confirm('Are you sure?')">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                            Update
                                                        </a>
                                                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Employee Name</th>
                                            <th>Address</th>
                                            <th>Department</th>
                                            <th>Date of Birth</th>
                                            <th>Age</th>
                                            <th>Hired date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end data table multiselects  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
    <div id="add_emp_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Employee</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ route('employee.store') }}">
                            {{ csrf_field() }}

                            <div class="md-form mb-3">
                                <label><strong>First Name:</strong></label>
                                <input type="text" id="firstname" name="firstname" class="form-control validate">
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Last Name:</strong></label>
                                <input type="text" id="lastname" name="lastname" class="form-control validate">
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Address:</strong></label>
                                <input type="text" id="address" name="address" class="form-control validate">
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Country:</strong></label>
                                <select class="form-control" name="country_id">
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>State:</strong></label>
                                <select class="form-control" name="state_id">
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>City:</strong></label>
                                <select class="form-control" name="city_id">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Age:</strong></label>
                                <input type="text" id="age" name="age" class="form-control validate">
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Date Of Birth:</strong></label>
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" id="date_of_birth" name="date_of_birth" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="yyyy/mm/dd"/>
                                    </div>
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Date Hired:</strong></label>
                                <div class="input-group date">
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="text" id="date_hired" name="date_hired"  class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Department:</strong></label>
                                <select class="form-control" name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-form mb-3">
                                <label><strong>Picture:</strong></label>
                                <input type="file" id="picture" name="picture"class="form-control validate">
                            </div>
                            <div class="md-form mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
@endsection