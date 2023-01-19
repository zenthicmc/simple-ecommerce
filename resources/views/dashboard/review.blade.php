@extends('layouts.dashboard-app')

@section('content')
<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="col-md-12">
        <div class="alert alert-success text-white" style="border: none;" role="alert">
          {{ $message }}
        </div>
    </div>
    @endif
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Reviews</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
			<a class="btn btn-primary" style="margin-left: 17px;font-size: 12px;" href="{{ route('review_new') }}">Create Review</a>
        <div class="table-responsive p-4">
          <table class="table align-items-center mb-0" id="table">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Star</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
               @foreach ($reviews as $review)
               <tr>
                  <td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold">{{ $review->name }}</span>
                  </td>

						<td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold"><i class="fa-solid fa-star text-warning me-1"></i>{{ $review->star }}</span>
                  </td>

						@php
                    $description = filter_var($review->description,FILTER_SANITIZE_STRING);

                    	if(strlen($description) >= 40) {
                     	$description = substr($description, 0, 40). '...';
                    	}
                  @endphp

                  <td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold">{{ $description }}</span>
                  </td>

						 <td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold">{{ $review->created_at }}</span>
                  </td>
						
                  <td class="align-middle d-flex">
                    <div class="col-md-2">
                        <a href="{{ route('review_edit',$review->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <span class="badge bg-warning">
                            <i class="fa-solid fa-pen me-1"></i>
                            Edit
                          </span>
                        </a>
                    </div>
                    <div class="col-md-2 ms-3">
                        <form method="post" action="{{ route('review_delete', $review->id) }}">@csrf<input type="hidden" name="_method" value="DELETE"><button style="background: none;border: none;" type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <span class="badge bg-danger">
                            <i class="fa-solid fa-trash me-1"></i>
                            Delete
                          </span>
                        </button></form>
                    </div>
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
<script>
  $(document).ready(function () {
    $('#table').DataTable();
  });
</script>
@endsection