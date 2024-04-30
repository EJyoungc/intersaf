<div>
  {{-- Stop trying to control. --}}
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Discount</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active">Discount</li>
                  </ol>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

      <div class="row">
          <div class="col-lg-12">
              
              <div class="card">
                  <div class="card-body">
                      <h4>Discount %</h4>
                      <form wire:submit.prevent='update'>
                          <div class="form-group">
                              <input type="text" class="form-control" wire:model='discount'>
                          </div>
                          <button class="btn btn-dark" type="submit">save</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>


</div>