<div>

    <!-- Create Department Modal -->
    <div wire:ignore.self class="modal fade modal-end" id="createDepartmentModal" data-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 pb-5">
                    <div class="text-center mb-2">
                        <h2 class="mb-1">Create New Department</h2>
                    </div>
                    <form wire:submit.prevent="storeDepartment">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-12">
                            <label class="form-label" for="modalDepartmentName">Department Name </label>
                            <input type="text" placeholder="Department Name" autofocus id="name" class="form-control" wire:model="name">
                            @error('name')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Create Department</button>
                            <button type="reset" class="btn btn-outline-secondary mt-2" data-dismiss="modal" aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




        <div wire:ignore.self  class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">New Record</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form wire:submit.prevent="storeDepartment" id="formdepartmemnt" name="formdepartmemnt">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <div class="mb-1">
                        <label class="form-label" for="name">Department Name</label>
                        <input type="text" placeholder="Department Name" autofocus id="name" class="form-control" wire:model="name">
                        @error('name')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-display-name">HOD</label>
                        <div wire:ignore>
                        <select wire:model="selectedhod"  id="selectedhod"  multiple class="hod-select2 select2 form-select ">

                            @foreach($teams as $team)
                                <option value="{{$team->id}}"> {{$team->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        @error('selectedhod')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-5">
                        <label class="form-label" for="basic-default-password1">Member</label>
                        <div wire:ignore>
                            <select wire:model="selectedmember"  id="selectedmember"  multiple class="hod-select2 select2 form-select ">
                                @foreach($teams as $team)
                                <option value="{{$team->id}}"> {{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('selectedmember')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                    <button type="reset" class="btn btn-label-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>

                </form>

            </div>
        </div>
    @script
    <script>
        const formdepartmemnt = document.getElementById('formdepartmemnt');
        const formhod = jQuery(formdepartmemnt.querySelector('[id="selectedhod"]'));

        if (formhod.length) {


            formhod.wrap('<div class="position-relative"></div>');
            formhod.select2({
                placeholder: '  Select HOD',
                dropdownParent: formhod.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()
                    console.log(data);
                    $wire.set('selectedhod', data,false)
                    // Revalidate the color field when an option is chosen
                    // fv.revalidateField('formCustomer');
                });

        }

        const formmember = jQuery(formdepartmemnt.querySelector('[id="selectedmember"]'));

        if (formmember.length) {


            formmember.wrap('<div class="position-relative"></div>');
            formmember.select2({
                placeholder: '  Select Member',
                dropdownParent: formmember.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()

                    $wire.set('selectedmember', data,false)
                    // Revalidate the color field when an option is chosen
                    // fv.revalidateField('formCustomer');
                });

        }
    </script>
    @endscript




        <div class="card">
            <h5 class="card-header"></h5>
{{--            <div class="flex items-center justify-between d p-4">--}}
{{--                <div class="d-flex">--}}
{{--                    <x-button class="btn-sm" data-toggle="modal" data-target="#createDepartmentModal">--}}
{{--                        Create New Department--}}
{{--                    </x-button>--}}
{{--                    <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="#createDepartmentModal">Create New Department</button>--}}
{{--                </div>--}}
{{--                <div class="flex">--}}
{{--                    <div class="relative w-full">--}}
{{--                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                        </div>--}}
{{--                        <input wire:model.live.debounce.300ms="search" type="text"--}}
{{--                               class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full  pl-10 p-2 "--}}
{{--                               placeholder="Search" required="">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

            <div class="row mx-1 mt-3 mb-2">
                <div
                    class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                    <div class="dataTables_length" id="">Show <label><select wire:model.live='perPage'
                                                                             name="DataTables_Table_0_length"
                                                                             aria-controls="DataTables_Table_0"
                                                                             class="form-select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select></label></div>
                    <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3 mb-2">

                    </div>
                </div>
                <div
                    class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                    <div
                        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input
                                    wire:model.live.debounce.300ms="search" type="search"
                                    class="form-control"
                                    placeholder="Search.."
                                    aria-controls="DataTables_Table_0"></label>
                        </div>
                        <div class="">
                            <div class="btn-group">
                            </div>


                            <button class="btn btn-secondary mb-2 mx-3 btn-primary waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">{{$add_btn_title}}</button>

                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        @include('livewire.includes.table-sortable-th',[
                            'name' => 'default',
                            'displayName' => 'Type'
                        ])
                        @include('livewire.includes.table-sortable-th',[
                            'name' => 'name',
                            'displayName' => 'Department'
                        ])
                        @include('livewire.includes.table-sortable-th',[
                            'name' => 'name',
                            'displayName' => 'Total Member'
                        ])
                        @include('livewire.includes.table-sortable-th',[
                            'name' => 'updated_at',
                            'displayName' => 'Updated At'
                        ])
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">


                    @foreach ($departments as $record)
                        <tr wire:key="{{ $record->id }}" >
                            <td><span class="badge bg-label-info me-1">{{ $record->default}}</span></td>
                            <td><span class="fw-medium">  {{ $record->name }}</span></td>
                            <td>0</td>
                            <td>{{ $record->created_at->diffForHumans() }}</td>

                            <td>

                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                                        <a class="dropdown-item" wire:click="deleteConfirm({{ $record->id }})"><i class="ti ti-trash me-1"></i> Delete</a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-4 px-3">

                {{ $departments->links() }}
            </div>

        </div>





</div>

