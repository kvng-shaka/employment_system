@extends('system-mgt.country.base')

@section('content')
<?php
    $countries = App\Employee::all();
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
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-8">
                                <h2 class="box-title">List of Country</h2>
                                </div>
                                <div class="col-sm-4">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add_country_Modal">Add new country</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">System Management</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Department</li>
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
                                            <th>Country Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($countries as $country)
                                        <tr>
                                                <td>{{$country->name}}</td>
                                                <td>
                                                    <form class="row" method="POST" action="{{ route('country.destroy', $country->id) }}" onsubmit = "return confirm('Are you sure?')">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <a href="{{ route('country.edit',  $country->id) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                            Update
                                                        </a>
                                                        &nbsp;&nbsp;
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
    <div id="add_country_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Country</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ route('country.store') }}">
                            {{ csrf_field() }}

                            <div class="md-form mb-3">
                                <label><strong>Country Name:</strong></label>
                                <input type="text" id="name" name="name" class="form-control validate">
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