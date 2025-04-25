@extends('layouts.main')
@section('title'.'Add New Levels')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5> Edit Categories</h5>
              <div class="card-title">

                <form action="{{route('levels.update',$edit->id)}}" method="POST">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="" class="col-form-label">Levels Name</label>
                    <input type="text" class="form-control" name="level_name" placeholder="Enter Your Levels name" 
                    value="{{$edit->level_name}}" required>
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="submit">Cancel</button>
                    <a href="{{url()->previous()}}" class="text-primary">Back</a>
                  </div>
                </form>

              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection