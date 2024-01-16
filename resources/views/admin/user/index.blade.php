@extends('admin.files.layouts')

@section('title', $module_name)

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $module_name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        @if (auth()->user()->hasPermission('user.create'))
                            <div class="breadcrumb float-sm-right">
                                <a class="btn btn-primary float-right" href="{{ route('user.create') }}"><i
                                        class="fa-solid fa-plus"></i> Create New</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header d-flex align-items-center">
                                <div class="Status">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <lable for="role" class="m-1">Select Role</lable>
                                            <select class="role w-100" name="role" id="role">
                                                <option value=""></option>
                                                @if (!empty($Role))
                                                    @foreach ($Role as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <lable for="status" class="m-1">Select Status</lable>
                                            <select class="status w-100" name="status" id="status">
                                                <option value=""></option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="ml-3 mt-4 Filter">
                                    <button class="btn border border-danger " id="clearfilter"><i
                                            class="fa-solid fa-filter-circle-xmark"></i> Clear
                                        Filter</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                User Role
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    {{-- success message --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('success') }}",
                icon: 'success',
                showCloseButton: true,
                confirmButtonText: 'Ok  <i class="fa-regular fa-thumbs-up"></i>',
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {

            // datatable
            var table = $('#example').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.index') }}",
                    data: function(d) {
                        d.role_id = $('#role').val(),
                            d.status = $('#status').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        searchable: true,
                    },
                    {
                        data: 'userrole',
                        searchable: true,
                    },
                    {
                        data: 'email',
                        searchable: true,
                    },
                    {
                        data: 'status',
                        searchable: true,
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            // Inactive to active btn
            $("#example").on('click', '.activate', function(e) {
                e.preventDefault();
                var input = $(this);
                var Id = input.data("id");
                Swal.fire({
                    title: "Are you sure want to Active?",
                    icon: "warning",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('user.status') }}",
                            data: {
                                'id': Id,
                            },
                            success: function(Id) {
                                table.ajax.reload();
                            }
                        });
                    }
                });
            });

            // Active to inactive btn
            $("#example").on('click', '.deactivate', function(e) {
                e.preventDefault();
                var input = $(this);
                var Id = input.data("id");
                Swal.fire({
                    title: "Are you sure want to Inactive?",
                    icon: "warning",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('user.status') }}",
                            data: {
                                'id': Id,
                            },
                            success: function(Id) {
                                table.ajax.reload();
                            }
                        });
                    }
                });
            });

            // delete btn
            $("#example").on('click', '.delete', function(e) {
                e.preventDefault();
                var input = $(this);
                var Id = input.data("id")

                Swal.fire({
                    title: "Are you sure ?",
                    text: "Are you sure you want to delete this user.",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('user.destroy') }}",
                            data: {
                                'id': Id,
                            },
                            success: function(Id) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted successfully!',
                                    'success'
                                )
                            }
                        });
                    }
                })
            });

            // status filter
            $('#status').change(function() {
                table.draw();
            });
            //role filter
            $('#role').change(function() {
                table.draw();
            });

            // clearfilter
            $("#clearfilter").click(function() {
                $('#role').val(null).trigger('change');
                $('#status').val(null).trigger('change');
            });

            // statusselect2 dropdown
            $('.status').select2({
                placeholder: "--- Select Status ---",
                theme: 'bootstrap4',
            });

            $('.role').select2({
                placeholder: "--- Select Role ---",
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection
