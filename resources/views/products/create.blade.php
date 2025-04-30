@extends('layouts.main')
@section('title', 'Add New Categories')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5> Add New Product</h5>
              <div class="card-title">

                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" placeholder="Enter Your Product name" required>
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Category Name *</label>
                   <select name="category_id" id="" class="form-control">
                    <option value="">Select One</option>

                    @foreach ($products as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                   </select>
                  </div>
                  
                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Price</label>
                    <input type="number" class="form-control" name="product_price" placeholder="Enter Your Price" required>
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Description</label>
                    <input type="text" class="form-control" name="product_description" placeholder="Enter Your Description" required>
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Product Photo</label>
                    <input type="file" class="form-control" name="product_photo" >
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Status</label>
                    <br>
                    Publish <input type="radio" name="is_active" value="1" checked>
                    Draft <input type="radio" name="is_active" value="0">
                  </div>

                  <div class="mb-3">
                    <label for="" class="col-form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" placeholder="Enter Your stock product" required>
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