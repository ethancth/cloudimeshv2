<div>





        <div wire:ignore.self  class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCD" aria-labelledby="offcanvasCDLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasCDLabel" class="offcanvas-title">{{$canvas_title}}</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form wire:submit.prevent="storeDepartment" id="formdepartmemnt" name="formdepartmemnt">
                    <input class="hidden"  name="_token" value="{{ csrf_token() }}">
                    <div class="mb-1">
                        <label class="form-label" for="name">Department Name</label>
                        <input type="text" placeholder="Department Name" autofocus id="name" class="form-control" @if($is_default_department) readonly @endif wire:model="name">
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


                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Save</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2 btn-ac-canvas" data-bs-dismiss="offcanvas"
                                aria-label="Close">
                            Discard
                        </button>
                    </div>


                </form>

            </div>
        </div>
    @script()
    <script>


        window.addEventListener('swal:modal',event=>{

            Swal.fire({
                icon: 'success',
                title: event.detail[0].title,
                text: event.detail[0].text,
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        });
        window.addEventListener('swal:confirm',event=>{
            Swal.fire({
                icon: event.detail[0].type,
                title: event.detail[0].title,
                text: event.detail[0].text,
                confirmButtonText: 'Yes, Delete It',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
            }).then((willDelete)=>
                {
                    if(willDelete.value){
                        Livewire.dispatch('delete', { id: event.detail[0].id })
                    }
                }
            )
            ;
        });

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
                    // console.log(data);
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

        window.addEventListener('close-canvas', event =>{
            // $('#createDepartmentModal').modal('hide');
            $('.btn-ac-canvas').click();
            formmember.val('').trigger('change');
            formhod.val('').trigger('change');

        });
    </script>
    @endscript




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


                    @foreach ($departments as $record)
                        <tr wire:key="{{ $record->id }}" >
                            @if($record->default)
                                <td><span class="badge bg-label-primary me-1">Default</span></td>
                            @else
                                <td><span class="badge bg-label-success me-1">Custom</span></td>
                            @endif
                            <td><span class="fw-medium">  {{ $record->name }}</span></td>
                            <td>0</td>
                            <td>{{$record->lastupdate ?? 'unknow'}} - {{ $record->updated_at->diffForHumans() }}</td>

                            <td>

                                <div class="">

                                    <a wire:click="edit({{ $record->id }})" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCD" aria-controls="offcanvasCD"><i
                                            class="ti ti-pencil me-1"></i></a>

                                    @if(!$record->default)
                                    <a wire:click="deleteConfirm({{ $record->id }})"><i
                                            class="ti ti-trash me-1"></i></a>
                                        @endif

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

