<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <section class="py-5 mt-5">
        <div class="container">
           
            <div class="row">
                @forelse ($categories as $item)
                    <div class="col-lg-3">
                        <div class="card">
                            

                            <div class="card-body">
                                <h4 class="card-title">{{ $item->name }}</h4>
                                <a class="btn btn-success" href="{{ route('root.cat.products',$item->id) }}">View all</a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                <div class="py-5 d-flex justify-content-center align-items-lg-center ">
                                    <h1 class="text-muted">EMPTY</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
</div>
