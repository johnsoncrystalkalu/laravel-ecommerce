@extends('maindesign')


@section('section')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('message') }}
               </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($cart as $cart_products)
                    <tr>
                      <td><a href="{{route('product', $cart_products->product->id)}}" >{{$cart_products->product->product_title}}</a></td>
                      <td>{{$cart_products->product->product_price}}</td>
                      <td><img src="{{asset('products/'.$cart_products->product->product_image)}}" height="200"/></td>
                <td>
                        <form action="{{ route('delete.cart', $cart_products->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                            x
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
@endsection
