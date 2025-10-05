@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-12">


            <div class="block margin-bottom-sm">
              <div class="title"><strong>Order Table</strong></div>
              @if (session('message'))
              <span class="text-success">  {{session('message')}} </span>
                @endif
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Action</th>
                      <th>Invoice</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($orders as $order)
                    <tr>
                      <th scope="row">{{$order->user->name}}</th>
                      <td>{{$order->reciever_address}}</td>
                      <td>{{$order->reciever_phone}}</td>
                      <td>{{$order->product->product_title}}</td>
                      <td>{{$order->product->product_price}}</td>
                      <td><img src="{{asset('products/'.$order->product->product_image)}}" height="60"></td>
                      <td>
                        <form action="{{route('admin.changeorderstatus', $order->id)}}" method="POST">
                        @csrf
                        <select name="status" class="form-control">
                            <option value="{{$order->status}}">{{$order->status}}</option>
                            <option value="delivered">delivered</option>
                            <option value="pending">pending</option>
                        </select>
                        <input type="submit" name="submit" onclick="return confirm('Are you sure?')"  value="save" class="mt-2 btn btn-sm btn-info">
                        </form>
                      </td>
                      <td><a href="{{route('admin.downloadpdf', $order->id)}}" class="btn btn-sm btn-danger"> Downlaod PDF</td>

                    </tr>
                    @endforeach
                    {{$orders->links()}}
                  </tbody>
                </table>
                {{$orders->links()}}
              </div>
            </div>
          </div>

      </div>
    </div>
  </section>
@endsection
