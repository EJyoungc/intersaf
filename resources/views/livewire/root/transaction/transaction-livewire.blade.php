<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <section class="py-5 mt-5">
        <div class="container">
            <h4>Transaction Status</h4>
            <div class="alert alert-success" role="alert">
                <strong> Transaction Success</strong>
                <p>
                <div><span>Transaction ID :</span>{{ $order->stripe_id }}</div>
                <div><span>User :</span>{{ $order->user->name }}</div>
                <div><span>Total :</span>{{ $order->total }}</div>
                </p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body ">
                            @forelse ($products as $item)

                          <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between ">
                              
                              <div class="h4" >
                                <img style="height: 50px; width:50px" src="{{asset('assets/uploads/'.$item->product->image) }}" alt="">  
                                
                                {{ $item->product_name}}
                              </div>
                              <span class="badge bg-success">{{$item->product_price}}</span>
                            </a>

                          </div>

                            @empty

                                <div class="py-5 d-flex justify-content-center align-items-lg-center ">
                                    <h1 class="text-muted">EMPTY</h1>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
