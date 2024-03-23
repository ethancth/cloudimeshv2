@extends('layouts/layoutMaster')

@section('title', 'User Management')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
    <script>

        /**
         * Page User List
         */

        'use strict';

        // Datatable (jquery)
        $(function () {
            // Variable declaration for table
            var dt_user_table = $('.datatables-users'),
                select2 = $('.select2'),
                userView = baseUrl + 'user-management',
                offCanvasForm = $('#offcanvasAddUser');

            if (select2.length) {
                var $this = select2;
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Select Country',
                    dropdownParent: $this.parent()
                });
            }

            // ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Users datatable
            if (dt_user_table.length) {
                var dt_user = dt_user_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: baseUrl + 'user-list'
                    },
                    columns: [
                        // columns according to JSON
                        { data: '' },
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'email' },
                        { data: 'role' },
                        { data: 'email_verified_at' },
                        { data: 'action' }
                    ],
                    columnDefs: [
                        {
                            // For Responsive
                            className: 'control',
                            searchable: false,
                            orderable: false,
                            responsivePriority: 2,
                            targets: 0,
                            render: function (data, type, full, meta) {
                                return '';
                            }
                        },
                        {
                            searchable: false,
                            orderable: false,
                            targets: 1,
                            render: function (data, type, full, meta) {
                                return `<span>${full.fake_id}</span>`;
                            }
                        },
                        {
                            // User full name
                            targets: 2,
                            responsivePriority: 4,
                            render: function (data, type, full, meta) {
                                var $name = full['name'],
                                    $image = full['profile_pic'],
                                    $role = full['division_name'];


                                if ($image) {
                                    // For Avatar image
                                    var $output =
                                        '<img src="' + $image + '" alt="Avatar" height="32" width="32" class="rounded-circle">';
                                } else {
                                    // For Avatar badge
                                    var stateNum = Math.floor(Math.random() * 6);
                                    var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                    var $state = states[stateNum],
                                        $initials = $name.match(/\b\w/g) || [];
                                    $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                    $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                                }


                                var $row_output =
                                    '<div class="d-flex justify-content-start align-items-center">' +
                                    '<div class="avatar-wrapper">' +
                                    '<div class="avatar me-2">' +
                                    $output +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="d-flex flex-column">' +
                                    '<a href="'+userView+'" class="text-body text-truncate"><span class="fw-medium">' +
                                    $name +
                                    '</span></a>' +
                                    '<small class="text-truncate text-muted">' +
                                    $role +
                                    '</small>' +
                                    '</div>' +
                                    '</div>';
                                return $row_output;
                            }
                        },
                        {
                            // User email
                            targets: 3,
                            render: function (data, type, full, meta) {
                                var $email = full['email'];

                                return '<span class="user-email">' + $email + '</span>';
                            }
                        },{
                            // User email
                            targets: 4,
                            render: function (data, type, full, meta) {
                                var $email = full['role'];

                                return '<span class="user-email">' + $email + '</span>';
                            }
                        },
                        {
                            // email verify
                            targets: 5,
                            className: 'text-center',
                            render: function (data, type, full, meta) {
                                var $verified = full['email_verified_at'];
                                return `${
                                    $verified
                                        ? '<i class="ti fs-4 ti-shield-check text-success"></i>'
                                        : '<i class="ti fs-4 ti-shield-x text-danger" ></i>'
                                }`;
                            }
                        },
                        {
                            // Actions
                            targets: -1,
                            title: 'Actions',
                            searchable: false,
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return (
                                    '<div class="d-inline-block text-nowrap">' +
                                    `<button class="btn btn-sm btn-icon edit-record" data-id="${full['id']}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i class="ti ti-edit"></i></button>` +
                                    `<button class="btn btn-sm btn-icon delete-record" data-id="${full['id']}"><i class="ti ti-trash"></i></button>` +
                                    '</div>'
                                );
                            }
                        }
                    ],
                    order: [[2, 'desc']],
                    dom:
                        '<"row mx-2"' +
                        '<"col-md-2"<"me-3"l>>' +
                        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
                        '>t' +
                        '<"row mx-2"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>',
                    language: {
                        sLengthMenu: '_MENU_',
                        search: '',
                        searchPlaceholder: 'Search..'
                    },
                    // Buttons with Dropdown
                    buttons: [

                        {
                            text: '<i class="ti ti-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New User</span>',
                            className: 'add-new btn btn-primary mx-3',
                            attr: {
                                'data-bs-toggle': 'offcanvas',
                                'data-bs-target': '#offcanvasAddUser'
                            }
                        }
                    ],
                });
            }

            // Delete Record
            $(document).on('click', '.delete-record', function () {
                var user_id = $(this).data('id'),
                    dtrModal = $('.dtr-bs-modal.show');

                // hide responsive modal in small screen
                if (dtrModal.length) {
                    dtrModal.modal('hide');
                }

                // sweetalert for confirmation of delete
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        // delete the data
                        $.ajax({
                            type: 'DELETE',
                            url: `${baseUrl}user-list/${user_id}`,
                            success: function () {
                                dt_user.draw();
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });

                        // success sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The user has been deleted!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'The User is not deleted!',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            });

            // edit record
            $(document).on('click', '.edit-record', function () {
                var user_id = $(this).data('id'),
                    dtrModal = $('.dtr-bs-modal.show');

                // hide responsive modal in small screen
                if (dtrModal.length) {
                    dtrModal.modal('hide');
                }

                // changing the title of offcanvas
                $('#offcanvasAddUserLabel').html('Edit User');
                document.getElementById("add-user-password").placeholder = "leave blank if don't want to change password.";

                // get data
                $.get(`${baseUrl}user-list\/${user_id}\/edit`, function (data) {
                    $('#user_id').val(data.id);
                    $('#add-user-fullname').val(data.name);
                    $('#add-user-email').val(data.email);
                    $('#add-user-password').val('');
                    $('#add-user-contact').val(data.contact);
                    $('#division').val(data.division_id).trigger('change');
                    $('#position').val(data.position_id).trigger('change');
                });
            });

            // changing the title
            $('.add-new').on('click', function () {
                $('#user_id').val(''); //reseting input field
                $('#add-user-password').val('');
                $('#division').val('').trigger('change');
                $('#position').val('').trigger('change');
                $('#offcanvasAddUserLabel').html('Add User');

                document.getElementById("add-user-password").placeholder = "Default password will be the email If Empty.";
            });

            // Filter form control to default size
            // ? setTimeout used for multilingual table initialization
            setTimeout(() => {
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm');
            }, 300);

            // validating form and updating user's data
            const addNewUserForm = document.getElementById('addNewUserForm');

            // user form validation
            const fv = FormValidation.formValidation(addNewUserForm, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter fullname'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your email'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        eleValidClass: '',
                        rowSelector: function (field, ele) {
                            // field is the field name & ele is the field element
                            return '.mb-3';
                        }
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                }
            }).on('core.form.valid', function () {
                // adding or updating user when form successfully validate
                $.ajax({
                    data: $('#addNewUserForm').serialize(),
                    url: `${baseUrl}user-list`,
                    type: 'POST',
                    success: function (status) {
                        dt_user.draw();
                        offCanvasForm.offcanvas('hide');

                        // sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: `Successfully ${status}!`,
                            text: `User ${status} Successfully.`,
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    },
                    error: function (err) {
                        offCanvasForm.offcanvas('hide');
                        Swal.fire({
                            title: 'Duplicate Entry!',
                            text: 'Your email should be unique.',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            });

            // clearing form data when offcanvas hidden
            offCanvasForm.on('hidden.bs.offcanvas', function () {
                fv.resetForm(true);
            });

        });

    </script>
@endsection

@section('content')


@endsection
