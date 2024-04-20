<div>
    {{-- Be like water. --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end ">
                        <button  wire:click='create'  class="btn btn-primary">add  <x-spinner for="create" /> </button>
                    </div>
                    <x-modal :status="$modal" title="add users">
                      <form wire:submit.prevent='store' >
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" class="form-control" wire:model='name'>
                          <x-error for="name" />
                        </div>
                        <div class="form-group">
                          <label for="">Email</label>
                          <input type="text" class="form-control" wire:model='email'>
                          <x-error for="email" />
                        </div>
                        <div class="form-group">
                          <label for="">Role</label>
                          <select  wire:model='role' class="form-control" >
                            <option value="">Select role</option>
                            <option value="admin">Administrator</option>
                            <option value="sales rep">Sales Rep</option>
                            <option value="operations manager">Operations Manager</option>
                            <option value="normal">Normal</option>
                          </select>
                          <x-error for="role" />

                        </div>
                        <div class="form-group">
                          <label for="">Password</label>
                          <input type="text" class="form-control" readonly wire:model='password'>
                        </div>

                        <button type="submit" class="btn btn-dark" > Save <x-spinner for="store" /></button>


                      </form>
                    </x-modal>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-inverse ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                          <td>{{ $user->id }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->role }}</td>
                                          <td>
                                              <div class="dropdown ">
                                                  <button class="btn btn-secondary dropdown-toggle" type="button"
                                                      id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false">
                                                      Dropdown
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="triggerId">
                                                      <button class="dropdown-item" wire:click='create({{ $user->id }})' >Edit</button>
                                                      <button class="dropdown-item" wire:click='delete({{ $user->id }})' wire:confirm='Are you sure you want to delete {{ $user->name }} ?'  >Delete</button>

                                                  </div>
                                              </div>

                                          </td>

                                      </tr>
                                        @empty
                                        empty
                                        @endforelse
                                        

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
