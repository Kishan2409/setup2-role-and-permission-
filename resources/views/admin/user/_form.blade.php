@extends('admin.files.layouts')

@section('title', $module_name . ' | Edit')

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
                            <form id="update" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label for="role">Select Role <span class="text-danger">*</span></label>
                                            <select class="role w-100" name="role" id="role">
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
                                                placeholder="Enter user name" value="{{ $data->name }}">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Enter email address" value="{{ $data->email }}">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <div class="mt-2 form-group clearfix">
                                                <div class="icheck-success d-inline ml-5">
                                                    <input type="radio" id="active" name="status" value="1"
                                                        {{ $data->status == 1 ? 'checked' : ' ' }}>
                                                    <label for="active">Active
                                                    </label>
                                                </div>
                                                <div class="icheck-danger d-inline ml-5">
                                                    <input type="radio" name="status" id="inactive" value="0"
                                                        {{ $data->status == 0 ? 'checked' : ' ' }}>
                                                    <label for="inactive">Inactive
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" id="password" name="password" class="form-control"
                                                    placeholder="Enter Password" oncopy="return disableCopy();"
                                                    onpaste="return disablePaste();" oncut="return disableCut();"
                                                    oncontextmenu="return disableContextMenu();">
                                                <span class="input-group-append">
                                                    <button tabindex="-1" type="button" id="password_btn"
                                                        class="btn btn-info btn-flat">
                                                        <i id="pass_btn" class="fa-solid fa-lock"></i>
                                                    </button>
                                                </span>
                                                <div class="col-12"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="password_confirmation">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input id="password_confirmation" name="password_confirmation"
                                                    type="password" class="form-control"
                                                    placeholder="Enter Confirm Password" oncopy="return disableCopy();"
                                                    onpaste="return disablePaste();" oncut="return disableCut();"
                                                    oncontextmenu="return disableContextMenu();">
                                                <span class="input-group-append">
                                                    <button tabindex="-1" type="button" id="password_confirmation_btn"
                                                        class="btn btn-info btn-flat"><i id="pass_con_btn"
                                                            class="fa-solid fa-lock"></i></button>
                                                </span>
                                                <div class="col-12"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Permission</label>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    {{-- @foreach ($permissions as $model => $modelPermissions)
                                                        <div class="card w-25">
                                                            <div class="card-header">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox" class="checkModel"
                                                                        id="content{{ $model }}"
                                                                        data-model="{{ $model }}">
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
                                                                            {{ in_array($permission->id, $approved) ? 'checked' : ' ' }}>
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
                                    <button class="btn btn-success mr-1"><i class="fa-solid fa-floppy-disk"></i>
                                        Save</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-primary"><i
                                            class="fa-solid fa-xmark"></i>
                                        Cancel</a>
                                </center>
                            </div>
                        </form>
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

        $("#update").validate({
            rules: {
                role: {
                    required: true,
                },
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                password: {

                    minlength: 8,
                },
                password_confirmation: {

                    minlength: 8,
                    equalTo: "#password"
                }
            },
            messages: {
                role: {
                    required: "Role is required.",
                },
                name: {
                    required: "Name is required.",
                },
                email: {
                    required: "Email address is required.",
                    email: "Please enter a valid email address."
                },
                password: {

                    minlength: "Please enter at least 8 characters."
                },
                password_confirmation: {

                    minlength: "Please enter at least 8 characters.",
                    equalTo: "Confirm password is not same as password."
                }
            },
            errorPlacement: function(error, element) {
                error.css('color', 'red').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':button[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });

        // select2 dropdown
        $('.role').select2({
            placeholder: "--- Select Role ---",
            theme: 'bootstrap4',
            allowClear: true
        });

        //password_eye_btn for view enter password
        $("#password_btn").click(function(e) {
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $('#pass_btn').removeClass('fa-solid fa-lock');
                $('#pass_btn').addClass('fa-solid fa-unlock-keyhole');
            } else {
                input.attr("type", "password");
                $('#pass_btn').removeClass('fa-solid fa-unlock-keyhole');
                $('#pass_btn').addClass('fa-solid fa-lock');
            }
            e.preventDefault();
        });

        //password_confirmation_eye_btn for view enter password
        $("#password_confirmation_btn").click(function(e) {
            e.preventDefault();
            var input = $("#password_confirmation");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $('#pass_con_btn').removeClass('fa-solid fa-lock');
                $('#pass_con_btn').addClass('fa-solid fa-unlock-keyhole');
            } else {
                input.attr("type", "password");
                $('#pass_con_btn').removeClass('fa-solid fa-unlock-keyhole');
                $('#pass_con_btn').addClass('fa-solid fa-lock');
            }
        });
    });
</script>
<script language="javascript" type="text/javascript">
    function disableCopy() {
        Swal.fire({
            title: "Error",
            text: "You cannot perform Copy.",
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok !',
        });
        return false;
    }

    function disablePaste() {
        Swal.fire({
            title: "Error",
            text: "You cannot perform Paste.",
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok !',
        });
        return false;
    }

    function disableCut() {
        Swal.fire({
            title: "Error",
            text: "You cannot perform Cut.",
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok !',
        });
        return false;
    }

    function disableContextMenu() {
        Swal.fire({
            title: "Error",
            text: "You cannot perform right click via mouse as well as keyboard.",
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok !',
        });

        return false;
    }
</script>
@endsection
