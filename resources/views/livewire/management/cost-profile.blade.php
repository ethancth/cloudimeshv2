<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row">
        <!-- Bootstrap Validation -->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$data->name}}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store"   id="costform" name="costform"  method="POST" accept-charset="UTF-8">
                        <input class="hidden"  name="_token" value="{{ csrf_token()}}">
                        <input class="hidden" name="form_id" id="form_id" value="{{$data->id}}">
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-addon-name">Name</label>

                                <input
                                    type="text"
                                    id="basic-addon-name"
                                    name="name"
                                    class="form-control"
                                    placeholder="Name"
                                    aria-label="Name"
                                    aria-describedby="basic-addon-name"
                                    wire:model="name"
                                    required
                                />
                                @error('name')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-desc">Description</label>
                                <input
                                    type="text"
                                    id="basic-default-desc"
                                    name="description"
                                    class="form-control"
                                    placeholder="Description"
                                    aria-label=""
                                    wire:model="description"
                                    required
                                />
                                @error('description')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vcpu-price">vCPU Price</label>
                                <input
                                    type="decimal"
                                    id="basic-default-vcpu-price"
                                    name="vcpu_price"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="vcpu_price"

                                    required
                                />
                                @error('vcpu_price')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vcpu-min">Minimum vCPU in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vcpu-min"
                                    name="form_vcpu_min"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="form_vcpu_min"
                                    required
                                />
                                @error('form_vcpu_min')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vcpu-max">Maximum vCPU in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vcpu-max"
                                    name="form_vcpu_max"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="form_vcpu_max"
                                    required
                                />
                                @error('form_vcpu_max')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vmen-price">vMemory Price</label>
                                <input
                                    type="decimal"
                                    id="basic-default-vmen-price"
                                    name="vmen_price"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="vmen_price"
                                    required
                                />
                                @error('vmen_price')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vmen-min">Minimum vMemory in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vmen-min"
                                    name="form_vmen_min"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="form_vmen_min"
                                    required
                                />
                                @error('form_vmen_min')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vmen-max">Maximum vMemory in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vmen-max"
                                    name="form_vmen_max"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="form_vmen_max"
                                    required
                                />
                                @error('form_vmen_max')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vstorage-price">vStorage Price (100 GB)</label>
                                <input
                                    type="decimal"
                                    id="basic-default-vstorage-price"
                                    name="vstorage_price"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="vstorage_price"
                                    required
                                />
                                @error('vstorage_price')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vstorage-min">Minimum vStorage in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vstorage-min"
                                    name="form_vstorage_min"
                                    class="form-control"
                                    min="100"
                                    placeholder="1"

                                    wire:model="form_vstorage_min"
                                    required
                                />
                                @error('form_vstorage_min')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-1 col-md-6 col-6">
                                <label class="form-label" for="basic-default-vstorage-max">Maximum vStorage in Form</label>
                                <input
                                    type="number"
                                    id="basic-default-vstorage-max"
                                    name="form_vstorage_max"
                                    class="form-control"
                                    min="0"
                                    placeholder="1"
                                    wire:model="form_vstorage_max"
                                    required
                                />
                                @error('form_vstorage_max')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <p>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Bootstrap Validation -->


    </div>
</div>
