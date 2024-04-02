<div class="">


    <div wire:ignore.self class="offcanvas offcanvas-end" tabindex="-1" id="offcanvascreate"
         aria-labelledby="offcanvascreateLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvascreateLabel" class="offcanvas-title">{{$canvas_title}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form wire:submit.prevent="store" id="formpolicy">

                <input class="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-1">

                    <label class="form-label" for="display_name">Environment </label>
                    <div wire:ignore>
                        <select wire:model="env_field"  id="env_field"  class="select2-env select2 form-select ">
                            <option></option>
                            @foreach($_env as $data_option)
                                <option value="{{$data_option->id}}"> {{$data_option->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('env_field')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-1">

                    <label class="form-label" for="env_field">Tier </label>
                    <div wire:ignore>
                        <select wire:model="tier_field"  id="tier_field"  class="select2-tier select2 form-select ">
                            <option></option>
                            @foreach($_tier as $data_option)
                                <option value="{{$data_option->id}}"> {{$data_option->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('tier_field')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-1">

                    <label class="form-label" for="os_field">Operating System </label>
                    <div wire:ignore>
                        <select wire:model="os_field"  id="os_field"  class="select2-os select2 form-select ">
                            <option></option>
                            @foreach($_os as $data_option)
                                <option value="{{$data_option->id}}"> {{$data_option->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('os_field')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror

                </div>


                <div class="mb-1">

                    <label class="form-label" for="mandatory_field">Mandatory </label>
                    <div wire:ignore>
                        <select wire:model="mandatory_field"  id="mandatory_field"  multiple class="select2-mf select2 form-select ">
                            @foreach($_as as $data_option)
                                <option value="{{$data_option->id}}"> {{$data_option->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('mandatory_field')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-1">

                    <label class="form-label" for="os_field">Optional </label>
                    <div wire:ignore>
                        <select wire:model="optional_field"  id="optional_field"  multiple class="select2-of select2 form-select ">

                            @foreach($_as as $data_option)
                                <option value="{{$data_option->id}}"> {{$data_option->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('optional_field')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror

                </div>


                <div class="mb-1 ">
                    <label class="form-label" for="status">Publish </label>
                    <select placeholder="is Publish?" autofocus  class="form-control"
                            wire:model="status">
                        <option value="1">Yes</option>
                        <option value="0">No</option>

                    </select>
                    @error('status')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary mt-2 me-1">Create</button>
                    <button type="reset" class="btn btn-outline-secondary mt-2 btn-ac-canvas" wire:click="click_close"
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

        const formpolicy = document.getElementById('formpolicy');
        const formenv = jQuery(formpolicy.querySelector('[id="env_field"]'));


        if (formenv.length) {

            formenv.wrap('<div class="position-relative"></div>');
            formenv.select2({
                placeholder: '  Select Environment',
                allowClear: true,
                dropdownParent: formenv.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()
                    $wire.set('env_field', data,false)
                });

        }

        const formtier = jQuery(formpolicy.querySelector('[id="tier_field"]'));
        if (formtier.length) {

            formtier.wrap('<div class="position-relative"></div>');
            formtier.select2({
                placeholder: '  Select Tier',
                allowClear: true,
                dropdownParent: formtier.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()
                    $wire.set('tier_field', data,false)
                });

        }

        const formos = jQuery(formpolicy.querySelector('[id="os_field"]'));
        if (formos.length) {

            formos.wrap('<div class="position-relative"></div>');
            formos.select2({
                placeholder: '  Select Operating System',
                allowClear: true,
                dropdownParent: formos.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()
                    $wire.set('os_field', data,false)
                });

        }

        const formmf = jQuery(formpolicy.querySelector('[id="mandatory_field"]'));
        if (formmf.length) {

            formmf.wrap('<div class="position-relative"></div>');
            formmf.select2({
                placeholder: 'Select Application',
                allowClear: true,
                closeOnSelect: false,
                dropdownParent: formmf.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()
                    $wire.set('mandatory_field', data,false)
                });

        }

        const formof = jQuery(formpolicy.querySelector('[id="optional_field"]'));
        if (formof.length) {

            formof.wrap('<div class="position-relative"></div>');
            formof.select2({
                placeholder: '  Select Application',
                allowClear: true,
                closeOnSelect: false,
                dropdownParent: formof.parent(),
            })
                .on('change.select2', function () {
                    let data= $(this).val()
                    $wire.set('optional_field', data,false)
                });

        }

        window.addEventListener('close-canvas', event => {
            // $('#createDepartmentModal').modal('hide');
            $('.btn-ac-canvas').click();

        });

        window.addEventListener('clear-canvas', event => {
            // $("#env_field").select2("val", "");
            // formenv.select2("val",'');
            $('#env_field').val(null).trigger('change');
            $('#tier_field').val(null).trigger('change');
            $('#os_field').val(null).trigger('change');
            $('#mandatory_field').val(null).trigger('change');
            $('#optional_field').val(null).trigger('change');
        });

        window.addEventListener('edit-canvas', event => {
            // $("#env_field").select2("val", "");
            // formenv.select2("val",'');
            $('#env_field').val(event.detail[0].env_field).trigger('change');
            $('#tier_field').val(event.detail[0].tier_field).trigger('change');
            $('#os_field').val(event.detail[0].os_field).trigger('change');
            $('#mandatory_field').val(event.detail[0].mandatory_field).trigger('change');
            $('#optional_field').val(event.detail[0].optional_field).trigger('change');
            $('#status').val(event.detail[0].status);
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
                                aria-controls="offcanvascreate">{{$add_btn_title}}</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'env_field',
                        'displayName' => 'Environment'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'tier_field',
                        'displayName' => 'Tier'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'os_field',
                        'displayName' => 'Operating System'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'mandatory_field',
                        'displayName' => 'Mandatory'
                    ])
                    @include('livewire.includes.table-sortable-th',[
                        'name' => 'optional_field',
                        'displayName' => 'Optional'
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

                        <td><span class="fw-medium">  {{ $data->env_name }}</span></td>
                        <td><span class="fw-medium">  {{ $data->tier_name }}</span></td>
                        <td><span class="fw-medium">  {{ $data->os_name }}</span></td>
                        <td><span class="fw-medium">  {{ $data->sa_man_name }}</span></td>
                        <td><span class="fw-medium">  {{ $data->sa_opt_name }}</span></td>


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

