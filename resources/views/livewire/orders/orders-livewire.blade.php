<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">order</li>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-inverse ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>Orderid</th>
                                            <th>User</th>
                                            <th>Cost</th>
                                            
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($orders as $item)
                                            <tr>
                                                <td scope="row">{{ $item->id }}</td>
                                                <td>{{$item->user->name}}</td>
                                                <td>Mwk{{ $item->total }}.00</td>
                                                <td><span class="badge bg-success" >{{ $item->status }}</span></td>
                                                <td>
                                                    <div class="dropdown ">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            options
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                                            <button class="dropdown-item" href="#">View
                                                                details</button>
                                                            {{-- <button class="dropdown-item" href="#">Edit</button> --}}
                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
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
