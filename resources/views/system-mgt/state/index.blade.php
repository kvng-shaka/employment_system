@extends('system-mgt.state.base')

@section('content')
<?php
    $countries = App\Country::all();
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
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-8">
                                <h2 class="box-title">List of States</h2>
                                </div>
                                <div class="col-sm-4">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add_state_Modal">Add new state</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">System Management</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">State</li>
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
                                <table id="datatable" class="table table-striped table-bordered" style="width:90%">
                                    <thead>
                                        <tr>
                                            <th>State Name</th>
                                            <th>Country Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $state)
                                        <tr>
                                                <td>{{$state->name}}</td>
                                                <td>{{$state->country_name}}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a data-toggle="modal" data-target="#edit_state_Modal" class="btn btn-info edit">
                                                            Edit
                                                        </a>
                                                        &nbsp;&nbsp;
                                                        <button type="submit" class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    </div>
                                                    
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>State Name</th>
                                            <th>Country Name</th>
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
    <div id="add_state_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New States</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{ route('state.store') }}">
                        {{ csrf_field() }}

                        <div class="md-form mb-3">
                            <label><strong>State Name:</strong></label>
                            <input type="text" id="name" name="name" class="form-control validate">
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
    <!-- ==========================Edit Modal==================================== -->
    <div id="edit_state_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit State</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="/state" id="editForm">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" class="form-control" id="state_id">
                        <div class="md-form mb-3">
                            <label><strong>State Name:</strong></label>
                            <input type="text" id="name1" name="name" class="form-control validate">
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
                            <button type="submit" class="btn btn-primary">
                                Update
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