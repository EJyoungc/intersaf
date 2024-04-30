<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <section class="py-5 mt-5 bg-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-dark text-white">
                        {{-- <img src="splash.png" class="card-img" alt="..."> --}}
                        {{-- <div class="card-img-overlay"> --}}
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="">Get the Latest Products</h1>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde tempore
                                    exercitationem beatae commodi assumenda nemo autem, laborum illum nihil rerum
                                    eius debitis quae dolorem eveniet ab quia non pariatur fugiat? Lorem, ipsum dolor
                                    sit amet consectetur adipisicing elit. Tempora laboriosam et accusamus illum! Saepe
                                    ipsam consectetur totam accusamus dicta ducimus, libero assumenda iusto nulla
                                    laboriosam eligendi fugit aspernatur animi. Ea.</p>
                                <button class="btn btn-primary">Join</button>
                            </div>
                        </div>
                        {{-- </div> --}}

                    </div>
                </div>
            </div>


        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h4 class="text-center">Categories</h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis voluptate tempore aperiam tempora
                consequuntur placeat quos adipisci, ipsa sint nobis quas dicta numquam magni suscipit eos nostrum velit
                facere libero.</p>
            <div class="row">
                <div class="col-lg-12">

                </div>
                @forelse ($categories as $item)
                    <div class="col-lg-4">
                        <div class="card">
                            <img src="" class="card-img" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <div class="py-2 ">
                                    <div class="list-group py-3">
                                        @foreach ($item->products as $p)
                                            <a href="#"
                                                class="list-group-item list-group-item-action ">{{ $p->name }}</a>
                                        @endforeach


                                    </div>
                                    <a href="{{ route('root.categories') }}" class="btn btn-success w-100"> More</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>

    <section class="py-5  bg-info">
        <div class="container">
            <h4 class="text-center text-uppercase fw-bold">Products</h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis voluptate tempore aperiam tempora
                consequuntur placeat quos adipisci, ipsa sint nobis quas dicta numquam magni suscipit eos nostrum velit
                facere libero.</p>
            <div class="row">
                <div class="col-lg-12">

                </div>
                @forelse ($products as $item)
                    <div class="col-lg-4">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/' . $item->image) }}" style="height:300px;"
                                class="card-img" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p><span class="badge bg-success">MWK {{ $item->price }}.00</span></p>
                                <a href="{{ route('root.products') }}" class="btn btn-success w-100"> More</a>

                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
    <section class="py-5 bg-dark text-light">
        <div class="container">
            <h4 class=" text-uppercase fw-bold">About us</h4>
            <div class="d-flex justify-content-center">
                <p class="px-2 col-lg-7">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis voluptate
                    tempore aperiam tempora
                    consequuntur placeat quos adipisci, ipsa sint nobis quas dicta numquam magni suscipit eos nostrum
                    velit
                    facere libero.</p>
            </div>

        </div>
    </section>
</div>
