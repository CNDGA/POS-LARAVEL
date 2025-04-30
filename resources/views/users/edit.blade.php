@extends('layouts.main')
@section('title'.'Add New Users')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5> Edit Categories</h5>
              <div class="card-title">

                <form action="{{route('users.update',$edit->id)}}" method="POST">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="" class="col-form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" 
                    value="{{$edit->name}}" required>
                  </div>
                  <div class="mb-3">
                    <label for="" class="col-form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Your Email" 
                    value="{{$edit->email}}" required>
                  </div>
                  <div class="mb-3">
                    <label for="" class="col-form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Your password" 
                    value="" >
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Level Name *</label>
                   <select name="level_id" id="" class="form-control">
                    <option value="">Select One</option>

                    @foreach ($levels as $level)
                    <option {{$edit->level_id ==$level->id ? 'selected' : ''}}
                    value="{{$level->id}}">{{$level->level_name}}</option>
                    @endforeach

                   </select>
                  </div>

                  <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="submit">Cancel</button>
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                  </div>
                </form>

              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection