@extends('layouts.main')
@section('title'.'Add Products')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5> Edit Products</h5>
              <div class="card-title">

                <form action="{{route('product.update', $edit->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" placeholder="Enter Your Product name" value="{{$edit->product_name}}" required>
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Category Name *</label>
                   <select name="category_id" id="" class="form-control">
                    <option value="">Select One</option>

                    @foreach ($categories as $category)
                    <option {{$edit->category_id ==$category->id ? 'selected' : ''}}
                    value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                   </select>
                  </div>
                  
                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Price</label>
                    <input type="number" class="form-control" name="product_price" placeholder="Enter Your Price"  value="{{$edit->product_price}}" required>
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Description</label>
                    <input type="text" class="form-control" name="product_description" placeholder="Enter Your Description" value="{{$edit->product_description}}" required>
                  </div>

                  <div class="mb-3">
                  @if ($edit->product_photo)
                  <img src="{{asset('storage/' . $edit->product_photo)}}"
                   alt="{{$edit->product_name}}" width="200">
                   <input type="file" name="product_photo">
                  @endif
                  </div>

                        <div class="mb-3">
                    <label for="" class="col-form-label">Status</label>
                    <br>
                    Publish <input type="radio" name="is_active" value="1"{{$edit->is_active ==1 ? 'checked' : ''}}>
                    Draft <input type="radio" name="is_active" value="0"{{$edit->is_active ==0 ? 'checked' : ''}}>
                  </div>

                  <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
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