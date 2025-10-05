@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong class="d-block">Edit Product</strong></div>
            <div class="block-body">
            @if (session('message'))
          <span class="text-success">  {{session('message')}} </span>
            @endif
              <form action="{{route('admin.postupdateproduct', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label class="form-control-label">Title</label>
                  <input type="text" name="product_title" value="{{$product->product_title}}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-control-label">Description</label>
                <textarea name="product_description" class="form-control"> {{$product->product_description}} </textarea>
             </div>

                <div class="form-group">
                    <label class="form-control-label">Quantity</label>
                    <input type="text" name="product_quantity" value="{{$product->product_quantity}}"  class="form-control">
                  </div>

                  <div class="form-group">
                    <label class="form-control-label">Price</label>
                    <input type="text" name="product_price" value="{{$product->product_price}}"  class="form-control">
                  </div>


                <div class="form-group">
                    <label class="form-control-label">Image</label>
                    <img src="{{asset('products/'.$product->product_image)}}" height="200"/>
                    <input type="file" name="product_image" class="form-control">
                  </div>

                  <div class="form-group">
                  <select name="product_category"  class="form-control">
                    <option value="{{$product->product_category}}">{{$product->product_category}}</option>
                    @foreach ( $categories as $category )
                    <option value="{{$category->category}}">{{$category->category}}</option>
                    @endforeach
                  </select>
                  </div>

                <div class="form-group">
                  <input type="submit" value="submit" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
