<div>
{{--  <section class="mt-10">--}}
{{--    <div class="mx-auto">--}}
{{--      <!-- Start coding here -->--}}
{{--      <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">--}}
{{--        <div class="flex items-center justify-between d p-4">--}}
{{--          <div class="flex">--}}
{{--            <div class="relative w-full">--}}
{{--              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--              </div>--}}
{{--              <input wire:model.live.debounce.300ms="search" type="text"--}}
{{--                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "--}}
{{--                     placeholder="Search" required="">--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="flex space-x-3">--}}
{{--            <div class="flex space-x-3 items-center">--}}
{{--              <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>--}}
{{--              <select wire:model.live="admin"--}}
{{--                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">--}}
{{--                <option value="">All</option>--}}
{{--                <option value="0">User</option>--}}
{{--                <option value="1">Admin</option>--}}
{{--              </select>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="overflow-x-auto">--}}
{{--          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">--}}
{{--            <thead class="text-xs text-gray-700 uppercase bg-gray-50">--}}
{{--            <tr>--}}
{{--              @include('livewire.includes.table-sortable-th',[--}}
{{--                  'name' => 'name',--}}
{{--                  'displayName' => 'Name'--}}
{{--              ])--}}
{{--              @include('livewire.includes.table-sortable-th',[--}}
{{--                  'name' => 'email',--}}
{{--                  'displayName' => 'Email'--}}
{{--              ])--}}
{{--              @include('livewire.includes.table-sortable-th',[--}}
{{--                  'name' => 'is_admin',--}}
{{--                  'displayName' => 'Role'--}}
{{--              ])--}}
{{--              @include('livewire.includes.table-sortable-th',[--}}
{{--                  'name' => 'created_at',--}}
{{--                  'displayName' => 'Joined'--}}
{{--              ])--}}
{{--              <th scope="col" class="px-4 py-3">Last update</th>--}}
{{--              <th scope="col" class="px-4 py-3">--}}
{{--                <span class="sr-only">Actions</span>--}}
{{--              </th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach ($users as $user)--}}
{{--              <tr wire:key="{{ $user->id }}" class="border-b dark:border-gray-700 bg-gray-900">--}}
{{--                <th scope="row"--}}
{{--                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">--}}
{{--                  {{ $user->name }}</th>--}}
{{--                <td class="px-4 py-3">{{ $user->email }}</td>--}}
{{--                <td class="px-4 py-3 {{ $user->is_admin ? 'text-green-500' : 'text-blue-500' }}">--}}
{{--                  {{ $user->is_admin ? 'Admin' : 'Member' }}</td>--}}
{{--                <td class="px-4 py-3">{{ $user->created_at }}</td>--}}
{{--                <td class="px-4 py-3">{{ $user->updated_at }}</td>--}}
{{--                <td class="px-4 py-3 flex items-center justify-end">--}}
{{--                  <button--}}
{{--                    onclick="confirm('Are you sure you want to delete {{ $user->name }} ?') || event.stopImmediatePropagation()"--}}
{{--                    wire:click="delete({{ $user->id }})"--}}
{{--                    class="px-3 py-1 bg-red-500 text-white rounded">X</button>--}}
{{--                </td>--}}
{{--              </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--          </table>--}}
{{--        </div>--}}

{{--        <div class="py-4 px-3">--}}
{{--          <div class="flex ">--}}
{{--            <div class="flex space-x-4 items-center mb-3">--}}
{{--              <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>--}}
{{--              <select wire:model.live='perPage'--}}
{{--                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">--}}
{{--                <option value="5">5</option>--}}
{{--                <option value="7">7</option>--}}
{{--                <option value="10">10</option>--}}
{{--                <option value="20">20</option>--}}
{{--                <option value="50">50</option>--}}
{{--                <option value="100">100</option>--}}
{{--              </select>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}
{{--        {{ $users->links() }}--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </section>--}}


  <section>
    <div class="card">
      <h5 class="card-header">Table</h5>
      <div class="flex items-center justify-between d p-4">
        <div class="flex">
          <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            </div>
            <input wire:model.live.debounce.300ms="search" type="text"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                   placeholder="Search" required="">
          </div>
        </div>
        <div class="flex space-x-3">
{{--          <div class="flex space-x-3 items-center">--}}
{{--            <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>--}}
{{--            <select wire:model.live="admin"--}}
{{--                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">--}}
{{--              <option value="">All</option>--}}
{{--              <option value="0">User</option>--}}
{{--              <option value="1">Admin</option>--}}
{{--            </select>--}}
{{--          </div>--}}
        </div>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
          <tr>
            @include('livewire.includes.table-sortable-th',[
                'name' => 'name',
                'displayName' => 'Status'
            ])
            @include('livewire.includes.table-sortable-th',[
                'name' => 'email',
                'displayName' => 'Email'
            ])
            @include('livewire.includes.table-sortable-th',[
                'name' => 'is_admin',
                'displayName' => 'Role'
            ])
            @include('livewire.includes.table-sortable-th',[
                'name' => 'created_at',
                'displayName' => 'Joined'
            ])
            <th scope="col" class="px-4 py-3">Last update</th>
            <th scope="col" class="px-4 py-3">
              <span class="sr-only">Actions</span>
            </th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">


          @foreach ($users as $user)
          <tr wire:key="{{ $user->id }}" >
            <td><span class="badge bg-label-info me-1">Draft</span></td>
            <td><span class="fw-medium">  {{ $user->name }}</span></td>
            <td>  {{ $user->currentTeam->id}}</td>
            <td>{{ $user->created_at }}</td>

            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                  <a class="dropdown-item"  onclick="confirm('Are you sure you want to delete {{ $user->name }} ?') || event.stopImmediatePropagation()"
                     wire:click="delete({{ $user->id }})"><i class="ti ti-trash me-1"></i> Delete</a>
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
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
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
      {{ $users->links() }}
    </div>
  </section>


</div>
