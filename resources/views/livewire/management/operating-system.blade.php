<div class="">


    <div wire:ignore.self class="offcanvas offcanvas-end" tabindex="-1" id="offcanvascreate"
         aria-labelledby="offcanvascreateLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvascreateLabel" class="offcanvas-title">{{$canvas_title}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form wire:submit.prevent="store">
                <input class="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-1">
                    <label class="form-label" for="name">Name </label>
                    <input type="text" placeholder="New {{$set_display_name}} Name" autofocus id="name"
                           class="form-control"
                           wire:model="name">
                    @error('name')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-1">
                    <label class="form-label" for="display_name">Display Name </label>
                    <input type="text" placeholder="Display Name" autofocus id="display_name" class="form-control"
                           wire:model="display_name">
                    @error('display_name')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-1">
                    <label class="form-label" for="display_description">Description </label>
                    <input type="text" placeholder="display_description" autofocus id="display_description"
                           class="form-control"
                           wire:model="display_description">
                    @error('display_description')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-1">
                    <label class="form-label" for="cost">Cost </label>
                    <input type="number" step="any" placeholder="Cost" autofocus id="Cost"
                           class="form-control"
                           wire:model="cost">
                    @error('cost')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="os_type">Os Platform </label>
                    <select autofocus id="os_type" class="form-control"
                            wire:model="os_type">
                        <option value="">Select OS</option>
                        <option value="windows">Windows</option>
                        <option value="rhel">RHEL</option>
                        <option value="centos">Centos</option>
                        <option value="other">Other</option>

                    </select>
                    @error('os_type')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-1">
                    <label class="form-label" for="status">Publish </label>
                    <select placeholder="is Publish?" autofocus id="status" class="form-control"
                            wire:model="status">
                        <option value="1">Yes</option>
                        <option value="0">No</option>

                    </select>
                    @error('status')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary mt-2 me-1">{{$canvas_btn_title}}</button>
                    <button type="reset" class="btn btn-outline-secondary mt-2 btn-ac-canvas"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close">
                        Discard
                    </button>
                </div>

            </form>

        </div>
    </div>


    @script
    <script>
        window.addEventListener('close-canvas', event => {
            $('.btn-ac-canvas').click();

        });

        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                icon: event.detail[0].type,
                title: event.detail[0].title,
                text: event.detail[0].text,
                confirmButtonText: 'Yes, Delete It',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
            }).then((willDelete) => {
                    if (willDelete.value) {
                        Livewire.dispatch('delete', {id: event.detail[0].id})
                    }
                }
            )
            ;
        });
    </script>
    @endscript


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

                        <button wire:click="click_add()"
                                class="btn btn-secondary mb-2 mx-3 btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvascreate"
                                aria-controls="offcanvascreate">{{$add_btn_title}} {{$set_display_name}}</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'name',
                        'displayName' => 'Name'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'display_name',
                        'displayName' => 'Display Name'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'cost',
                        'displayName' => 'Cost'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'status',
                        'displayName' => 'Publish'
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


                @foreach ($datas as $data)
                    <tr wire:key="{{ $data->id }}">

                        <td><span class="fw-medium">  {{ $data->name }}</span></td>

                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar  bg-light-null  me-1"><img
                                            src="{{asset('assets/img/os/'.$data->display_icon.'.png')}}" alt="Avatar"
                                            width="32" height="32"></div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a class="text-truncate text-body">
                                        <span class="fw-bolder">  {{ $data->display_name }}</span>
                                    </a>
                                    <small class="emp_post text-muted">
                                        {{ $data->display_description }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        <td><span class="fw-medium"> $ {{ $data->cost }}</span></td>

                        <td><span

                                class="badge @if($data->status=='1')bg-label-success @else bg-label-warning @endif me-1">{{ $data->publish_status  }}</span>
                        <td>{{$data->lastupdate ?? 'unknow'}} - {{ $data->updated_at->diffForHumans() }}</td>


                        <td>

                            <a wire:click="edit({{ $data->id }})" data-bs-toggle="offcanvas"
                               data-bs-target="#offcanvascreate" aria-controls="offcanvascreate"><i
                                    class="ti ti-pencil me-1"></i></a>

                            @if(!$data->is_default)
                                <a wire:click="deleteConfirm({{ $data->id }})"><i
                                        class="ti ti-trash me-1"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="py-4 px-3">

            {{ $datas->links() }}
        </div>
    </div>


</div>

