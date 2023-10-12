@extends('dashboard.layouts.master')
@section('title','View Order')
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">Products Details</h3>
                    <tr>
                        <th colspan="2">Product</th>
                        <th>Unit price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <td><img src="{{ asset('storage/products/'.$product->image) }}" style="height: 100px; width:100px" alt="{{ $product->name_en }}"></td>
                            <td>{{ $product->name_en }}</td>
                            <td>{{ $product->pivot->price }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">Order Details</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Delivered Date</th>
                        <td>{{ date('d-m-Y',strtotime($order->delivered_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                    <tr>
                        <th>Total Price</th>
                        <td>{{ $order->total_price }}</td>
                    </tr>   
                    <tr>
                        <th>Order Status</th>
                        <td>
                            <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">
                                @csrf
                                <select class="form-control" name="status">
                                    <option {{ $order->status == '0'?'selected':''}} value="0">Not Delivered</option>
                                    <option {{ $order->status == '1'?'selected':''}} value="1">Delivered</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-4">Update</button>
                            </form>
                        </td>
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">User Details</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $order->address->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->address->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Region</th>
                        <td>{{ $order->address->region->name_en }}</td>
                    </tr>
                    <tr>
                        <th>Street</th>
                        <td>{{ $order->address->street }}</td>
                    </tr>
                    <tr>
                        <th>Building</th>
                        <td>{{ $order->address->building }}</td>
                    </tr>
                    <tr>
                        <th>Floor</th>
                        <td>{{ $order->address->floor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

