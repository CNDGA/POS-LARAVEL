@extends('layouts.main')
@section('title'.'Order Detail')
@section('content')
  <section class="section">
    {{-- pos diambild dari route yg di web.php --}}


    <div class="row">
      <div class="col-lg-12">
        <div class="card-header d-flex justify-content-between align-item-center">
          <h3 class="card-title">{{$title ?? ''}}</h3>
          <div>
            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
            <a href="{{route('print', $order->id)}}" class="btn btn-success">
              <i class="bi bi-printer"></i>
            </a>
          </div>
        </div>

       

      <div class="card mt-3">
          <div class="card-body">
          
            <h5>Select Categories</h5>
            <table class="table table-bordered table-striped">
              <tr>
                <th>Order Code</th>
                <td>{{$order->order_code ?? ''}}</td>
              </tr>
              <tr>
                <th>Order Date</th>
                <td>{{$order->order_date ?? ''}}</td>
              </tr>
              <tr>
                <th>Order Status</th>
                <td>{{$order->order_status ?? ''}}</td>
              </tr>
            </table>

          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Order Basket</h5>

       <table class="table table-chover">
        <thead>
          <tr>
            <th>no</th>
            <th>Foto</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orderDetails as $key=> $orderDetail)
              <tr>
                <td>{{$key+= 1}}</td>
                <td><img src="{{asset('storage/' . $orderDetail->product->product_photo)}}" alt="" width="100"></td>
                <td>{{$orderDetail->product->product_name}}</td>
                <td>{{$orderDetail->qty}}</td>
                <td>{{number_format($orderDetail->order_price)}}</td>
                <td>{{number_format($orderDetail->order_subtotal)}}</td>
              </tr>
        @endforeach
        </tbody>
        
        <tfoot>
          <tr>
            <th colspan="2">Grand Total</th>
            <td colspan="3">
              <span class="grandtotal">{{ number_format($order->order_amount) }}</span>
              <input type="hidden" class="form-control" name="grandtotal">
            </td> 
          </tr>
        </tfoot>
        <table>
          <div class="mt-3">
            <button class="btn btn-success" type="submit">Confirm Order</button>
          </div>
        </table>
          

          </div>
        </div>
      </div>

    </div>

  </section>
@endsection