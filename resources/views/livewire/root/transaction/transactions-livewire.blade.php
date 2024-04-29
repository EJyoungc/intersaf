<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <section class="py-5 mt-5">
        <div class="container">
            <h4>Orders</h4>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body ">
                           <div class="table-responsive">
                            <table class="table table-hover table-inverse table-responsive">
                              <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Date</th>
                                  <th>User</th>
                                  <th>Total</th>
                                  <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                  @forelse ($orders as $item)
                                <tr>
                                  <td>{{$item->id}}</td>
                                  <td>{{$item->created_at}}</td>
                                  <td>{{$item->user->name}}</td>
                                  <td>{{$item->total}}</td>
                                  <td>
                                    <a href="{{route('root.transaction',$item->id)}}" class="btn btn-info"> View</a>
                                  </td>
                                </tr>

                            @empty
                                <tr>
                                  <td colspan="4" class="text-center" >EMPTY</td>
                                </tr>
                            @endforelse
                                </tbody>
                            </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
