<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
  <section class="py-5 mt-5">
    <div class="container">
      <div class="form-group py-3">
        <input type="text" wire:model.live='search' class="form-control rounded-5" placeholder="search">
      </div>
      <div class="row">
        @forelse ($products as $item)
           <div class="col-lg-3">
          <div class="card">
            <img class="card-img-top" style="height: 250px;" src="{{ asset('assets/uploads/'.$item->image) }}" alt="">
            
            <div class="card-body">
              <h4 class="card-title">{{ $item->name }}</h4>
              <p class="card-text">
                <div class="badge bg-info" >{{ $item->category->name }}</div>
                
                <div>MWK{{ $item->price }}.00</div>

              </p>
              <button wire:click='add_to_cart({{ $item->id }})' class="btn w-100 btn-success text-white" > <span class="ti h4 ti-shopping-bag" ></span></button>
            </div>
          </div>
        </div> 
        @empty
            <div class="col-lg-12">
             <div class="card">
              <div class="card-body ">
                <div class="py-5 d-flex justify-content-center align-items-lg-center ">
                  <h1 class="text-muted" >EMPTY</h1>
                </div>
              </div>
             </div>
            </div>
        @endforelse
        
      </div>
    </div>
  </section>
</div>
