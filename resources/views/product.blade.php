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

            <div class="card shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="{{ asset('products/' . $product->product_image) }}"
                             alt="{{ $product->product_title }}"
                             class="img-fluid rounded-start"
                             style="height: 100%; object-fit: cover;">
                    </div>

                    <div class="col-md-7">
                        <div class="card-body">
                            <h3 class="card-title fw-bold mb-3">{{ $product->product_title }}</h3>
                            <p class="text-muted small mb-3">Category: {{ $product->product_category }}</p>

                            <p class="card-text mb-4">{{ $product->product_description }}</p>

                            <h4 class="text-primary mb-4">${{ number_format($product->product_price, 2) }}</h4>

                            <p><strong>Available Quantity:</strong> {{ $product->product_quantity }}</p>

                            <div class="d-flex gap-3 mt-4">
                                @if ($in_cart)
                                <form action="{{ route('delete.cart', $in_cart->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        Remove from cart
                                    </button>
                                </form>
                                @else
                                <a href="{{route('addtocart', $product->id)}}" class="btn btn-primary">Add to Cart</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
