<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="col-12 mb-6">
        <div class="card">
            <div class="card-body">
                <h1>Project - {{$project->title}} </h1>
                <hr class="mb-2" />
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Total -
{{--                                {{$project->server->count()}} --}}
                                Server</h6>

                        </div>

                        <div>
                            <h6 class="text">Daily Cost -  <span class="badge badge-light-success profile-badge">$ {{$project->price}}</span> </h6>

                        </div>
                    </div>

                </div>

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text">Tier -
{{--                                @foreach($project->server()->distinct()->get(['display_tier'])  as $_value)--}}
{{--                                    <span class="badge badge-light-success profile-badge">{{$_value->display_tier}}</span>--}}
{{--                                    </span>--}}
{{--                                @endforeach--}}
                            </h6>
                            <h6 class="text">Environment -
{{--                                @foreach($project->server()->distinct()->get(['display_env'])  as $_value)--}}
{{--                                    <span class="badge badge-light-success profile-badge">{{$_value->display_env}}</span>--}}
{{--                                    </span>--}}
{{--                                @endforeach--}}

                            </h6>

                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">CPU</h6>
{{--                            <h3 class="mb-0">{{$project->server->sum('v_cpu')}} </h3>--}}
                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">Memory</h6>
{{--                            <h3 class="mb-0">{{$project->server->sum('v_memory')}} GB</h3>--}}
                        </div>
                        <div>
                            <h6 class="text-muted fw-bolder">Storage</h6>
{{--                            <h3 class="mb-0">{{$project->server->sum('total_storage')}} GB</h3>--}}
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>

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


                        <button class="btn btn-secondary mb-2 mx-3 btn-primary waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCD" aria-controls="offcanvasCD">{{$add_btn_title}}</button>

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


                @foreach ($data as $record)
                    <tr wire:key="{{ $record->id }}" >

                        <td><span class="fw-medium">  {{ $record->hostname }}</span></td>
                        <td>0</td>
{{--                        <td>{{$record->lastupdate ?? 'unknow'}} - {{ $record->created_at->diffForHumans() }}</td>--}}

                        <td>

                            <div class="">

{{--                                <a wire:click="edit({{ $record->id }})" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCD" aria-controls="offcanvasCD"><i--}}
{{--                                        class="ti ti-pencil me-1"></i></a>--}}

{{--                                @if(!$record->default)--}}
{{--                                    <a wire:click="deleteConfirm({{ $record->id }})"><i--}}
{{--                                            class="ti ti-trash me-1"></i></a>--}}
{{--                                @endif--}}

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="py-4 px-3">

{{--            {{ $departments->links() }}--}}
        </div>

    </div>
</div>
