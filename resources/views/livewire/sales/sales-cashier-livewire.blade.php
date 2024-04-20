<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cashier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cashier</li>
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
                    <div class="d-flex">
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" wire:model.live='search'
                                placeholder="Search Products">
                            <div>
                                @if (!empty($search))
                                    <div class="list-group">
                                        
                                        @forelse ($products as $item)
                                            <a href="#" wire:click.prevent='add_to_cart({{ $item->id }})'
                                                class="list-group-item list-group-item-action d-flex justify-content-between ">
                                                <div>{{ $item->name }}</div>
                                                <div><span class="badge bg-dark">{{ $item->quantity }}</span></div>
                                                <div><span class="badge bg-success" > MWK{{ $item->price }}.00</span></div>
                                            </a>
                                        @empty
                                            <a href="#" class="list-group-item list-group-item-action">EMPTY</a>

                                        @endforelse
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                          <div class="card-title">Cart</div>
                                        </div>
                                        <div class="card-body">
                                         @dump($totalPrice)
                                          @forelse ($cart as $item)
                                          <div class="list-group">
                                              <a href="#"
                                                  class="list-group-item list-group-item-action d-flex justify-content-between">
                                                  <div>{{ $item['name'] }}  <span class="badge bg-info" > MWK{{ $item['price'] }}.00</span></div>
                                                  <div><span class="badge bg-dark">{{ $item['quantity'] }}</span></div>
                                                  <div>
                                                     <button class="btn btn-success btn-sm" wire:click='add_to_cart({{ $item['id'] }})' >Add</button>
                                                     <button class="btn btn-info btn-sm" wire:click='subtract_from_cart({{ $item['id'] }})' >Subtract</button>
                                                      <button class="btn btn-danger btn-sm" wire:click='remove_from_cart({{ $item['id'] }})'>Remove</button>

                                                  </div>
                                              </a>
                                          @empty
                                              <div class="list-group">
                                                  <a href="#"
                                                      class="list-group-item list-group-item-action d-flex justify-content-between">
  
                                                  </a>
                                      @endforelse
                                        </div>
                                    </div>
                            


                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>
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
