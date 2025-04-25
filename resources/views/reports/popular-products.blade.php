
@extends('layouts.main')
@section('title'.'Add New Categories')
@section('content')
<div class="container">
  <h2>Produk Paling Laris</h2>
  <table class="table">
      <thead>
          <tr>
              <th>#</th>
              <th>Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Jumlah Pesanan</th>
          </tr>
      </thead>
      <tbody>
          @foreach($products as $product)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->category->category_name }}</td>
              <td>{{ number_format($product->product_price, 0, ',', '.') }}</td>
              <td>{{ $product->order_details_count }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
  {{ $products->links() }}
</div>
@endsection