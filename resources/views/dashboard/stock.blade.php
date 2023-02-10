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
        <h6>Stocks</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <a class="btn btn-primary" style="margin-left: 17px;font-size: 12px;" href="{{ route('stock_new') }}">Add Stock</a>
          <a class="btn btn-success" style="margin-left: 10px;font-size: 12px;" href="{{ route('stock_import') }}">Import Stock</a>
          <table class="table align-items-center mb-0 p-4" id="table">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unlimited</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Content</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expire At</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
                
               @foreach ($stocks as $stock)
               <tr>
                  <td>
                    <div class="d-flex px-3 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $stock->code }}</p>
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="d-flex px-3 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <span style="font-size: 10px;" class="badge badge-sm bg-gradient-{{ $stock->product->category->color }}">{{ $stock->product->name }}</span>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $stock->isUnlimited == 'false' ? 'No' : 'Yes' }}</span>
                  </td>

                  @php
                    $description = filter_var($stock->content,FILTER_SANITIZE_STRING);

                    if(strlen($description) >= 40) {
                      $description = substr($description, 0, 40). '...';
                    }
                  @endphp

                  <td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold">{{ $description }}</span>
                  </td>

                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $stock->expire_at }}</span>
                  </td>


                  <td class="align-middle">
                    <div class="col-md-2">
                        <a href="{{ route('stock_edit',$stock->code) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <span class="badge bg-warning">
                            <i class="fa-solid fa-pen me-1"></i>
                            Edit
                          </span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <form method="post" action="{{ route('stock_delete', $stock->code) }}">@csrf<input type="hidden" name="_method" value="DELETE"><button style="background: none;border: none;" type="submit" class="text-secondary font-weight-bold text-xs m-0 p-0">
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