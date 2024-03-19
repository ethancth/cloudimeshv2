<div>


  <!-- Create Project Modal -->
  <div wire:ignore.self class="modal fade" id="createProjectModal" data-backdrop="static" tabindex="-1" aria-hidden="true">
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
              <input type="text" placeholder="Project Name" autofocus id="title" class="form-control" wire:model="title">
              @error('title')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary mt-2 me-1">Create Project</button>
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


  <section>


    <div class="card">
      <h5 class="card-header"></h5>
      <div class="flex items-center justify-between d p-4">
        <div class="flex">
          <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#createProjectModal">Create New Project</button>
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
            <tr wire:key="{{ $project->id }}" >
              <td><span class="badge bg-label-info me-1">Draft</span></td>
              <td><span class="fw-medium">  {{ $project->title }}</span></td>
              <td>$  {{ $project->price}}</td>
              <td>{{ $project->created_at }}</td>

              <td>

                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                    <a class="dropdown-item" wire:click="deleteConfirm({{ $project->id }})"><i class="ti ti-trash me-1"></i> Delete</a>

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
      {{ $projects->links() }}
    </div>
  </section>




</div>
