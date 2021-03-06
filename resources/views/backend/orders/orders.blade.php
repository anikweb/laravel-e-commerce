@extends('backend.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Orders </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">My Orders </li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Ordered Product</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <td>#</td>
                                    <td>Order id</td>
                                    <td>Billing Name</td>
                                    <td>Product Name</td>
                                    <td>Total Price</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $orders->firstItem() + $loop->index }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>
                                                @foreach ($order->order_summary as $order_summary)
                                                    @foreach ($order_summary->order_details as $order_details)
                                                        {{ App\Models\Product::find($order_details->product_id)->title }}
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($order->order_summary as $order_summary)
                                                    {{ '$'.$order_summary->total_price }}
                                                @endforeach
                                            </td>
                                            <td><span class="badge badge-primary">Panding</span></td>
                                            <td>
                                                <a target="_blank" href="{{ route('download.customer.invoice',$order->id) }}" class="btn-sm btn-info"><i class="fa fa-eye"></i> View Invoice</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center"><i class="fa fa-exclamation-circle"></i> No data to show</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                         <div class="mt-2">
                          {{ $orders->links() }}
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
