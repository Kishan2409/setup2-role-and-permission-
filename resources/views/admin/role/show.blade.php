@extends('admin.files.layouts')

@section('title', $module_name . ' | View')

@section('main')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="h5">
                                            {{ $module_name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 mb-2">
                                        <label for="role">Role Name <span class="text-danger">*</span></label>
                                        <input type="text" id="role" name="role" class="form-control"
                                            placeholder="Enter role name" value="{{ $data->name }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <div class="mt-2 form-group clearfix">
                                            <div class="icheck-success d-inline ml-5">
                                                <input type="radio" id="active" name="status" value="1"
                                                    @if ($data->status == 1) checked @endif disabled>
                                                <label for="active">Active
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline ml-5">
                                                <input type="radio" name="status" id="inactive" value="0"
                                                    @if ($data->status == 0) checked @endif disabled>
                                                <label for="inactive">Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer rounded-bottom border-top bg-white">
                                <center>
                                    <a href="{{ route('role.index') }}" class="btn btn-primary"><i
                                            class="fa-solid fa-xmark"></i>
                                        Cancel</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
