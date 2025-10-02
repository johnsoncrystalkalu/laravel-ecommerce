@extends('admin.maindesign')

@section('section')
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-6">
            <div class="block margin-bottom-sm">
              <div class="title"><strong>Category Table</strong></div>
              @if (session('message'))
              <span class="text-success">  {{session('message')}} </span>
                @endif
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($category as $categories)
                    <tr>
                      <th scope="row">{{$categories->id}}</th>
                      <td>{{$categories->category}}</td>
                      <td>
                        <form action="{{ route('admin.deletecategory', $categories->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                    <a href="{{route('admin.updatecategory', $categories->id)}}" class="btn btn-sm btn-info">Update</a>
                </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>

      </div>
    </div>
  </section>
@endsection
