<div>
    {{-- In work, do what you enjoy. --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
                        <button wire:click='create' class="btn btn-primary">add Category
                            <x-spinner for="create" />
                        </button>
                        <x-modal :status="$modal" title="add category">


                            <form wire:submit.prevent='store'>

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" wire:model='name'>
                                    <x-error for="name" />
                                </div>

                                <button type="submit" class="btn btn-dark"> Save <x-spinner for="store" /></button>

                            </form>
                        </x-modal>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover table-inverse ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>id</th>
                                            <th>Category</th>
                                            <th></th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $c)
                                            <tr>
                                                <td scope="row">{{$c->id}}</td>
                                                <td>{{$c->name}}</td>
                                                <td>
                                                    <div class="dropdown ">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            options
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                                            <button class="dropdown-item" wire:click.prevent='edit({{$c->id}})' >Edit</button>

                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3" scope="row"> EMPTY</td>
                                            </tr>
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
