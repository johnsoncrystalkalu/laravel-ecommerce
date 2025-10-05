@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-6">
            <div class="block margin-bottom-sm">
              <div class="title"><strong>Coupons Table</strong></div>
              @if (session('message'))
              <span class="text-success">  {{session('message')}} </span>
                @endif
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Discount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($coupons as $coupon)
                    <tr>
                      <th scope="row">{{$coupon->code}}</th>
                      <td>{{$coupon->discount}}</td>
                      <td>
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                    <a href="{{route('coupons.edit', $coupon->id)}}" class="btn btn-sm btn-info">Update</a>
                </td>
                    </tr>
                    @endforeach
                    {{$coupons->links()}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      </div>
    </div>
  </section>
@endsection
