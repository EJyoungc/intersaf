<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <li class="nav-item">
      <a class="btn btn-info " wire:click.prevent='viewcart' href="#"> Cart <i class="ti ti-shopping-cart" ></i> <span class="badge bg-light text-dark " >{{ $cart->count() }}</span>  </a>
  </li>
  <x-modal :status="$modal" title="Cart" >
     
    <div class="list-group">
      @forelse ($cart as $item)
      <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between" aria-current="true">
        <div>{{ $item->product->name }}</div>
        <div>
          <span class="badge bg-dark">{{ $item->quantity }}</span> 
          <span class="badge bg-success" > MWK{{ $item->product->price }}.00</span>
        </div>
        <div>
          <div class="btn-group">
            <button class="btn btn-sm btn-success " wire:click.prevent='add_quantity({{ $item->product_id }})'>+</button>
            <button class="btn btn-sm btn-secondary " wire:click.prevent='subtract_quantity({{ $item->product_id }})' >-</button>
            <button class="btn btn-sm btn-danger " wire:click.prevent='remove_from_cart({{ $item->product_id }})'>X</button>
          </div>
        </div>
      </a>   
      @empty
      <a href="#"  class="list-group-item list-group-item-action d-flex justify-content-center  h3 text-muted" aria-current="true">
        EMPTY
      </a>   
      @endforelse
      
    
    </div>
    <div class="d-flex">
      <div class="me-auto p-2 " >
      
        <div class="">Total MWK{{ $totalPrice }}.00</div>
        <div class="">Discount {{ $discount }}%</div>
      </div>
      <div class="ms-auto p-2">
        <button class="btn btn-primary" wire:click.prevent="checkout">Checkout</button>
      </div>
    </div>
  </x-modal>
</div>
