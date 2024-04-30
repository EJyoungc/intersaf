<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-lg-4">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4>Sales</h4>
                                <h1>{{ $orders->count() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4>Revenue</h4>
                                <h1>{{ $Revenue }}</h1>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-primary">
                        <div class="card-body ">
                            <div class="d-flex justify-content-between">
                                <h4>Products</h4>
                                <h1>{{ $products->count() }}</h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info" wire:click='create'>Report</button>
                        <x-modal :status="$modal" title="Report" >
                            @if ($modal)
                            <iframe style="width: 100%; height:500px" src="{{ route('pdf.report') }}" frameborder="0"></iframe>
                            @endif
                        </x-modal>
                    </div>
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
                                            <th></th>
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
