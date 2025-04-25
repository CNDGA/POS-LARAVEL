
@extends('layouts.main')
@section('title','Data levels')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$title ?? '' }}</h5>
         <div class="mt-4 mb-3">
          <div align="right" class="mb-3">
            {{-- categories di ambil dari web.php create di ambil dari controller --}}
            <a href="{{route('levels.create')}}" class="btn btn-primary ">Add Categories</a>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              @php $no=1; @endphp
              @foreach ($levels as $index => $data)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$data->level_name}}</td>
                <td>
                  <a href="{{route('levels.edit',$data->id)}}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <form action="{{route('levels.destroy', $data->id)}}" class="d-inline" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-warning">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>

                </td>
              </tr>
              @endforeach
            </tbody>

          </table>
         </div>
        </div>
      </div>

    </div>

    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Example Card</h5>
          <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
