<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">



              <div class="table-responsive">
                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
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
                      <td>{{$order->status}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>



</div>

</div>
</div>
</x-app-layout>
