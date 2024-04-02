<div class="">



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
                            <input type="text" placeholder="Project Name" autofocus class="form-control"
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



    <h5 class="card-header"></h5>

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
                        <button class="btn btn-secondary mb-3 mx-3  btn-primary waves-effect waves-light" tabindex="0"
                                aria-controls="DataTables_Table_0" type="button" data-toggle="modal"
                                data-target="#createProjectModal"><span><i class="ti ti-plus me-0 me-sm-1"></i><span
                                    class="d-none d-sm-inline-block">{{$add_btn_title}}</span></span></button>
                    </div>
                </div>
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
                        <td><span class="fw-medium" wire:click="viewProjectDetail({{$project->id}})">  {{ $project->title }}</span></td>
                        <td>$ {{ $project->price}}</td>
                        <td>{{ $project->created_at->diffForHumans() }}</td>

                        <td>
                            <a wire:navigate.click href="{{ route('project.detail', ['id' => $project  ->id,'slug'=>$project->title]) }}"><i
                                    class="ti ti-search me-1"></i></a>

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

