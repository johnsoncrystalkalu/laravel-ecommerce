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
                    @php
                        $price = 0;
                    @endphp
                    @foreach ($cart as $cart_products)
                    <tr>
                      <td><a href="{{route('product', $cart_products->product->id)}}" >{{$cart_products->product->product_title}}</a></td>
                      <td>{{$cart_products->product->product_price}}</td>
                      <td><img src="{{asset('products/'.$cart_products->product->product_image)}}" height="80"/></td>
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
                    @php
                    $price = $price + $cart_products->product->product_price;
                    @endphp
                    @endforeach
                    <tr style="background: silver">
                        <td class="">Total</td>
                        <td><b>USD {{$price}}</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <form action="{{route('confirm.order')}}" method="POST">
                @csrf
                <input type="text" name="reciever_address" placeholder="Enter address" class="form-control" required/>
                <input type="text" name="reciever_phone" placeholder="Enter Phone" class="form-control mt-2" required/>
                <input type="submit" name="submit" value="confirm order" class="btn btn-success mt-2"/>

                <a href="{{route('stripe', $price)}}" class="btn btn-info">Pay now </a>
            </form>
        </div>
    </div>
</div>
@endsection
