<div>


    <!-- Create Department Modal -->
    <div wire:ignore.self class="modal fade" id="createDepartmentModal1" data-backdrop="static" tabindex="-1" aria-hidden="true">
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
    <!--/ Add Permission Modal -->
    <div class="modal modal-slide-in fade" id="createDepartmentModal">
        <div class="modal-dialog sidebar-sm">
            <div class="add-new-record modal-content pt-0" id="modal_env_form" name="modalenvform">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="form-label" name="form-label">New Record</h5>
                </div>

                <div class="modal-body flex-grow-1">
                    <form class="needs-validation" novalidate id="envform" name="envform"  method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                        <input class="hidden" name="form_id" id="form_id" value="">
                        <div class="mb-1">
                            <label class="form-label" for="basic-addon-name">Name</label>

                            <input
                                type="text"
                                id="basic-addon-name"
                                name="basic_addon_name"
                                class="form-control"
                                placeholder="e.g. Windows"
                                aria-label="Name"
                                required
                                aria-describedby="basic-addon-name"
                            />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter operating system name.</div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-display-name">Display Name</label>
                            <input
                                type="text"
                                id="basic-default-display-name"
                                name="basic_default_display_name"

                                class="form-control"
                                placeholder="MS Window 11"
                                aria-label="Display Name"
                                required
                            />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a display name</div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-password1">Description</label>
                            <input
                                type="text"
                                id="basic-default-desc"
                                name="basic_default_desc"
                                class="form-control"
                                placeholder="Short sentence about operating system.."
                                minlength="5"
                                required
                            />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter your sentence.</div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="basic-default-password1">Cost</label>
                            <input
                                type="decimal"
                                id="basic-default-cost"
                                name="basic_default_cost"
                                class="form-control"
                                placeholder="$10"
                                min="1"
                                required
                                pattern="^\d*(\.\d{0,2})?$"
                            />
                            <small>This cost is Cost per day(temporary decision)</small>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter your Cost.</div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="select-os-platform">OS Platform</label>
                            <select class="form-select" id="select-os-platform" name="select_os_platform" required>
                                <option value="">Select OS Platform</option>
                                <option value="windows">Windows</option>
                                <option value="rhel">RHEL</option>
                                <option value="centos">Centos</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please select Operating System Platform</div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="select-status">Publish</label>
                            <select class="form-select" id="select-status" name="select_status" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please select colour label</div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <section>


        <div class="card">
            <h5 class="card-header"></h5>
            <div class="flex items-center justify-between d p-4">
                <div class="flex">
                    <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#createDepartmentModal">Create New Department</button>
                </div>
                <div class="flex">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text"
                               class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                               placeholder="Search" required="">
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
                            'name' => 'created_at',
                            'displayName' => 'Create At'
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
                            <td>{{ $record->created_at }}</td>

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
                <div class="flex ">
                    <div class="flex space-x-4 items-center mb-3">
                        <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                        <select wire:model.live='perPage'
                                class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

            </div>
            {{ $departments->links() }}
        </div>
    </section>




</div>

