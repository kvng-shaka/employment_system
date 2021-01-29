@extends('system-mgt.department.base')

@section('content')
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
                                <h2 class="box-title">List of departments</h2>
                                </div>
                                <div class="col-sm-4">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add_dept_Modal">Add new department</a>
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
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Department Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $department)
                                        <tr>
                                                <td>{{$department->name}}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#edit_dept_Modal" class="btn btn-warning edit">
                                                        Edit
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Department Name</th>
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
    <div id="add_dept_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Department</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ route('department.store') }}">
                            {{ csrf_field() }}

                            <div class="md-form mb-3">
                                <label><strong>Department Name:</strong></label>
                                <input type="text" id="dept_name" name="dept_name" class="form-control validate">
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


    <div id="edit_dept_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Department</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="/department" id="editForm">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" class="form-control" id="dept_id">
                            <div class="md-form mb-3">
                                <label><strong>Department Name:</strong></label>
                                <input type="text" id="dept_name1" name="dept_name" class="form-control validate">
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
