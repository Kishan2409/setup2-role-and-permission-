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
                                        <label for="role">Select Role <span class="text-danger">*</span></label>
                                        <select class="role w-100" name="role" id="role" disabled>
                                            <option value=""></option>
                                            @foreach ($Role as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $role->id == $data->role_id ? 'selected' : ' ' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter user name" value="{{ $data->name }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="Enter email address" value="{{ $data->email }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <div class="mt-2 form-group clearfix">
                                            <div class="icheck-success d-inline ml-5">
                                                <input type="radio" id="active" name="status" value="1"
                                                    {{ $data->status == 1 ? 'checked' : ' ' }} disabled>
                                                <label for="active">Active
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline ml-5">
                                                <input type="radio" name="status" id="inactive" value="0"
                                                    {{ $data->status == 0 ? 'checked' : ' ' }} disabled>
                                                <label for="inactive">Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <label>Permission</label>
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                {{-- @foreach ($permissions as $model => $modelPermissions)
                                                    <div class="card w-25 mr-2">
                                                        <div class="card-header">
                                                            <div class="icheck-primary d-inline">
                                                                <input type="checkbox" class="checkModel"
                                                                    id="content{{ $model }}"
                                                                    data-model="{{ $model }}" disabled>
                                                                <label
                                                                    for="content{{ $model }}">{{ $model }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @foreach ($modelPermissions as $permission)
                                                                <div class="icheck-primary d-inline ">
                                                                    <input type="checkbox" class="chk"
                                                                        id="content{{ $permission->id }}"
                                                                        name="permission[]"
                                                                        data-model="{{ $model }}"
                                                                        value="{{ $permission->id }}"
                                                                        {{ in_array($permission->id, $approved) ? 'checked' : ' ' }}
                                                                        disabled>
                                                                    <label
                                                                        for="content{{ $permission->id }}">{{ $permission->description }}</label>
                                                                </div>
                                                                <div></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach --}}
                                                @foreach ($permissions as $model => $modelPermissions)
                                                    <div class="card w-25">
                                                        <div class="card-header">
                                                            <div class="icheck-primary d-inline">
                                                                {{-- Use a variable to check if all permissions for the model are checked --}}
                                                                @php
                                                                    $allPermissionsChecked = true;
                                                                @endphp
                                                                @foreach ($modelPermissions as $permission)
                                                                    @unless (in_array($permission->id, $approved))
                                                                        {{-- If any permission is not checked, set the variable to false --}}
                                                                        @php
                                                                            $allPermissionsChecked = false;
                                                                        @endphp
                                                                        {{-- Break out of the loop once a permission is not checked --}}
                                                                    @break
                                                                @endunless
                                                            @endforeach

                                                            {{-- Use the variable to determine whether to check the model checkbox --}}
                                                            <input type="checkbox" class="checkModel"
                                                                id="content{{ $model }}"
                                                                data-model="{{ $model }}"
                                                                {{ $allPermissionsChecked ? 'checked' : '' }}>
                                                            <label
                                                                for="content{{ $model }}">{{ $model }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($modelPermissions as $permission)
                                                            <div class="icheck-primary d-inline">
                                                                <input type="checkbox" class="chk"
                                                                    id="content{{ $permission->id }}"
                                                                    name="permission[]"
                                                                    data-model="{{ $model }}"
                                                                    value="{{ $permission->id }}"
                                                                    {{ in_array($permission->id, $approved) ? 'checked' : '' }}>
                                                                <label
                                                                    for="content{{ $permission->id }}">{{ $permission->description }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer rounded-bottom border-top bg-white">
                            <center>
                                <a href="{{ route('user.index') }}" class="btn btn-primary"><i
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

@section('script')

<script>
    $(document).ready(function() {
        $(".checkModel").change(function() {
            const model = $(this).data('model');
            $(`.chk[data-model="${model}"]`).prop('checked', $(this).prop("checked"));
        });

        // Check/uncheck the model checkbox when all related checkboxes are checked/unchecked
        $(".chk").change(function() {
            const model = $(this).data('model');
            const allChecked = $(`.chk[data-model="${model}"]:checked`).length === $(
                `.chk[data-model="${model}"]`).length;
            $(`.checkModel[data-model="${model}"]`).prop('checked', allChecked);
        });


        // select2 dropdown
        $('.role').select2({
            placeholder: "--- Select Role ---",
            theme: 'bootstrap4',
            allowClear: true
        });
    });
</script>

@endsection
