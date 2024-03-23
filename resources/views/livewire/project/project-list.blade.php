<div>


    <!-- Create Project Modal -->
    {{--  //<div wire:ignore.self class="modal fade" role="dialog" tabindex="-1" id="createProjectModal" data-dismiss="modal" aria-hidden="true">--}}
    <div wire:ignore.self class="modal fade" id="createProjectModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 pb-5">
                    <div class="text-center mb-2">
                        <h2 class="mb-1">Create New Project</h2>
                    </div>
                    <form wire:submit.prevent="storeProject">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-12">
                            <label class="form-label" for="modalProjectName">Project Name </label>
                            <input type="text" placeholder="Project Name" autofocus id="title" class="form-control"
                                   wire:model="title">
                            @error('title')
                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Create Project</button>
                            <button type="reset" class="btn btn-outline-secondary mt-2" data-dismiss="modal"
                                    aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--/ Add Permission Modal -->






        {{--      <h5 class="card-header"></h5>--}}
        {{--      <div class="flex items-center justify-between d p-4">--}}
        {{--        <div class="form">--}}
        {{--          <button role="button" class="btn btn-sm  mt-50 btn-primary" style="float: right;" data-toggle="modal" data-target="#createProjectModal">Create New Project</button>--}}
        {{--        </div>--}}
        {{--        <div class="flex">--}}
        {{--          <div class="relative w-full">--}}
        {{--            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
        {{--            </div>--}}
        {{--            <input wire:model.live.debounce.300ms="search" type="text"--}}
        {{--                   class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "--}}
        {{--                   placeholder="Search" required="">--}}
        {{--          </div>--}}
        {{--        </div>--}}



        {{--      </div>--}}

        {{--        <div class="row mx-2">--}}
        {{--            <div class="col-md-2">--}}
        {{--                <div class="me-3">--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-10">--}}
        {{--                <div--}}
        {{--                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">--}}
        {{--                    <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input wire:model.live.debounce.300ms="search" type="search"--}}
        {{--                                                                                                class="form-control"--}}
        {{--                                                                                                placeholder="Search.."--}}
        {{--                                                                                                aria-controls="DataTables_Table_0"></label>--}}
        {{--                    </div>--}}
        {{--                    <div class="">--}}
        {{--                        <div class="btn-group">--}}
        {{--                        </div>--}}
        {{--                        <button class="btn btn-secondary mb-3 mx-3  btn-primary waves-effect waves-light" tabindex="0"--}}
        {{--                                aria-controls="DataTables_Table_0" type="button"  data-toggle="modal" data-target="#createProjectModal"><span><i class="ti ti-plus me-0 me-sm-1"></i><span--}}
        {{--                                    class="d-none d-sm-inline-block">Add New User</span></span></button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    <div class="card">
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
                    <div class="dt-buttons btn-group flex-wrap">
                        <button class="btn btn-secondary btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                                type="button"><span><i class="ti ti-plus me-md-1"></i><span
                                    class="d-md-inline-block d-none" data-toggle="modal"
                                    data-target="#createProjectModal">Create New Project</span></span></button>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                                                                                            wire:model.live.debounce.300ms="search"
                                                                                            class="form-control"
                                                                                            placeholder="Search.."
                                                                                            aria-controls="DataTables_Table_0"></label>
                </div>
                <div class="invoice_status mb-3 mb-md-0"></div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'status',
                        'displayName' => 'Status'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'title',
                        'displayName' => 'Project'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'price',
                        'displayName' => 'Cost'
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


                @foreach ($projects as $project)
                    <tr wire:key="{{ $project->id }}">
                        <td><span class="badge bg-label-info me-1">Draft</span></td>
                        <td><span class="fw-medium">  {{ $project->title }}</span></td>
                        <td>$ {{ $project->price}}</td>
                        <td>{{ $project->created_at }}</td>

                        <td>
                            <a wire:click="deleteConfirm({{ $project->id }})"><i
                                    class="ti ti-trash me-1"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="py-4 px-3">

            {{ $projects->links() }}
        </div>
    </div>


</div>

