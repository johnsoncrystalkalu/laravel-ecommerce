@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-12">
            <div class="block margin-bottom-sm">
              <div class="title"><strong>Product Table</strong></div>
              @if (session('message'))
              <span class="text-success">  {{session('message')}} </span>
                @endif
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Desc</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($product as $products)
                    <tr>
                      <th scope="row">{{$products->id}}</th>
                      <td>{{$products->product_title}}</td>
                      <td>{{$products->product_description}}</td>
                      <td>{{$products->product_category}}</td>
                      <td>{{$products->product_quantity}}</td>
                      <td>{{$products->product_price}}</td>
                      <td><img src="{{asset('products/'.$products->product_image)}}" height="200"/></td>
                <td>
                        <form action="{{ route('admin.deleteproduct', $products->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                    <a href="{{route('admin.updateproduct', $products->id)}}" class="btn btn-sm btn-info">Update</a>
                </td>
                    </tr>
                    @endforeach
                    {{$product->links()}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      </div>
    </div>
  </section>
@endsection
