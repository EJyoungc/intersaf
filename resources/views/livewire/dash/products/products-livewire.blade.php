<div>
    {{-- The whole world belongs to you. --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                <div class="col-lg-4">
                    <div class="card bg-info">
                        <div class="card-body">
                            <h4>Products</h4>
                            <h1>{{$products->count()}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-success">
                        <div class="card-body">
                            <h4>Product value</h4>
                            <h1>MKW {{$product_value }}.00</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <h4>Categories</h4>
                            <h1>{{$categories->count()}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <div class="form-group">
                            <button wire:click.prevent='create' class="btn btn-primary">add <x-spinner
                                    for="create"></x-spinner></button>
                            <x-modal :status="$modal" title="add Product">
                                <form wire:submit.prevent='store'>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" wire:model='name' class="form-control">
                                        <x-error for="name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <select class="form-control" wire:model='category'>
                                            <option value="">Select Category</option>
                                            @forelse ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty
                                                <option value="">Empty</option>
                                            @endforelse
                                        </select>
                                        <x-error for="category" />
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="button" onclick="document.getElementById('file').click();" >Upload <x-spinner for"image" /></button>
                                        <input type="file" id="file" wire:model.live='image' class="form-control d-none " >
                                        <x-error for="image" ></x-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="text" class="form-control" wire:model='quantity'>
                                        <x-error for="quantity" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" wire:model='price'>
                                        <x-error for="price" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea type="text" class="form-control" wire:model='description'></textarea>
                                        <x-error for="description" />
                                    </div>
                                    <button class="btn btn-dark" type="submit">
                                        save
                                        <x-spinner for="store" ></x-spinner>
                                    </button>

                                </form>
                            </x-modal>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-inverse ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>id</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $item)
                                        <tr>
                                            <td scope="row">{{$item->id}}</td>
                                            <td> <img style="height: 60px; width:60px;" src="{{ asset('assets/uploads/'.$item->image) }}" alt=""></td>
                                            <td>{{$item->name}} </td>
                                            <td>{{$item->category->name}} </td>
                                            <td>{{$item->quantity}} </td>
                                            <td> {{$item->price}} </td>
                                            <td>
                                                <div class="dropdown ">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        options
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                                        <button class="dropdown-item" wire:click.prevent='create({{$item->id}})' href="#">Edit</button>

                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center" >EMPTY</td>
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
