<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <li class="nav-item">
      <a class="btn btn-info " wire:click.prevent='viewcart' href="#"> Cart <i class="ti ti-shopping-cart" ></i> <span class="badge bg-light text-dark " >{{ $cart->count() }}</span>  </a>
  </li>
  <x-modal :status="$modal" title="Cart" >
    
    <div class="list-group">
      @forelse ($cart as $item)
      <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
        The current link item
      </a>   
      @empty
      <a href="#"  class="list-group-item list-group-item-action d-flex justify-content-center  h3 text-muted" aria-current="true">
        EMPTY
      </a>   
      @endforelse
      
    
    </div>
    <div class="d-flex">
      <div class="me-auto p-2" >
        <input type="text" class="form-control">
      </div>
      <div class="ms-auto p-2">
        <button class="btn btn-primary" wire:click="checkout">Checkout</button>
      </div>
    </div>
  </x-modal>
</div>
