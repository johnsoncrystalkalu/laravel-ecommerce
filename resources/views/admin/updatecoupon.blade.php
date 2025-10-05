@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong class="d-block">Edit Coupon</strong></div>
            <div class="block-body">
            @if (session('message'))
          <span class="text-success">  {{session('message')}} </span>
            @endif
              <form action="{{route('coupons.update', $coupon->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-control-label">Code</label>
                    <input type="text" name="code" value="{{$coupon->code}}" class="form-control">
                  </div>

                  <div class="form-group">
                      <label class="form-control-label">Discount</label>
                      <input type="number" name="discount" value="{{$coupon->discount}}" class="form-control">
                    </div>

                  <div class="form-group">
                    <input type="submit" value="submit" class="btn btn-success">
                  </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
