@props(['status'=>false,'title'=>'','slot'=>''])


<div class="modal {{ $status == 'true' ? 'show d-block' :'hide d-none' }}  " tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $title }}</h5>
          <button type="button"  class="btn-close {{ Auth::user()->role == "normal" ? 'd-none' : '' }} " @click="
          $wire.cancel();
          $wire.dispatch('modal-cancel');
      "  aria-label="Close"></button>
          <span class="{{ Auth::user()->role == "admin" ? 'd-none' : '' }}" type="button" @click="
          $wire.cancel();
          $wire.dispatch('modal-cancel');
      "
          > X <x-spinner for="cancel" /> </span>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>

      </div>
    </div>
  </div>
