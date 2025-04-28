
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
          <div align="right" class="mb-3">
            {{-- product diambild ari web.php create di ambil dari controller --}}
      
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Order Code</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Change</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              @php $no=1; @endphp
              @foreach ($datas as $index => $data)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$data->order_code}}</td>
                <td>{{$data->order_date}}</td>
                <td>Rp. {{number_format($data->order_amount)}}</td>
                <td>Rp. {{ number_format($data->order_change, 0, ',', '.') }}</td>
                <td>{{$data->order_status ? 'Paid' : 'Unpaid'}}</td>
               
                <td>
                  <a href="{{route('pos.print',$data->id)}}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-printer"></i>
                  </a>
                </td>
                {{-- <td>
                  <a href="{{route('pos.show',$data->id)}}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <a href="{{route('pos.edit', $data->id)}}" class="btn btn-sm btn-success">
                    <i class="bi bi-trash"></i>
                    
                  </a>

                </td> --}}
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
