@extends('layouts.dashboard-app')

@section('content')
<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade show text-white" style="border: none;" role="alert">
          <p class="text-white">{{ $message }}</p>
        </div>
    </div>
    @endif
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Users</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <a class="btn btn-primary" style="margin-left: 17px;font-size: 12px;" href="{{ route('users_new') }}">Create User</a>
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>
                  <div class="d-flex px-3 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  @if($user->role == 'admin')
                    <span class="badge badge-sm bg-gradient-danger">{{ $user->role }}</span>
                  @else
                    <span class="badge badge-sm bg-gradient-success">{{ $user->role }}</span>
                  @endif
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                </td>
                <td class="align-middle d-flex">
                  <div class="col-md-2">
                    <a href="{{ route('users_edit',$user->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      <span class="badge bg-warning">
                        <i class="fa-solid fa-pen me-1"></i>
                        Edit
                      </span>
                    </a>
                  </div>
                  <div class="col-md-2 ms-2">
                    <form method="post" action="{{ route('users_delete', $user->id) }}">@csrf<input type="hidden" name="_method" value="DELETE"><button style="background: none;border: none;" type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
@endsection