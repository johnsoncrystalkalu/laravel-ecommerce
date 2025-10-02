@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong class="d-block">Update catgegory</strong></div>
            <div class="block-body">
            @if (session('message'))
          <span class="text-success">  {{session('message')}} </span>
            @endif
              <form action="{{route('admin.postupdatecategory', $category->id)}}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="form-control-label">Category</label>
                  <input type="text" name="category" value="{{$category->category}}" class="form-control">
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
