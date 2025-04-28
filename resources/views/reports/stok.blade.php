
@extends('layouts.main')
@section('title','Data products')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$title ?? '' }}</h5>
         <div class="mt-4 mb-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Stock</th>
              </tr>
            </thead>
            <tbody>

              @php $no=1; @endphp
              @foreach ($stok as $index => $data)
              <tr>
                <td>{{$no++}}</td>
                <td><img src="{{asset('storage/'. $data->product_photo)}}" alt="" width="50"></td>
                <td>{{$data->product_name}}</td>
                <td>{{$data->stock}}</td>
              </tr>
              @endforeach
            </tbody>

          </table>
         </div>
        </div>
      </div>

    </div>

    <div class="col-lg-6">

    </div>
  </div>
</section>

@endsection
