@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="row gy-4">

    <!-- Transactions -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-primary rounded shadow">
                    <i class="mdi mdi-link mdi-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <div class="small mb-1">Links</div>
                  <h5 class="mb-0">{{ ($links >= 1000) ? $links/1000..'K' : $links }}</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-success rounded shadow">
                    <i class="mdi mdi-account-outline mdi-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <div class="small mb-1">Customers</div>
                  <h5 class="mb-0">{{ ($customers >= 1000) ? $customers/1000..'K' : $customers }}</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-warning rounded shadow">
                    <i class="mdi mdi-link-variant mdi-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <div class="small mb-1">Short Link</div>
                  <h5 class="mb-0">{{ ($short_links >= 1000) ? $short_links/1000..'K' : $short_links }}</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-info rounded shadow">
                    <i class="mdi mdi-calendar-today mdi-24px"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <div class="small mb-1">Today Links</div>
                  <h5 class="mb-0">{{ ($today_links >= 1000) ? $today_links/1000..'K' : $today_links }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Transactions -->

    <!-- Weekly Overview Chart -->
    <div class="col-xl-4 col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h5 class="mb-1">Weekly Overview</h5>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="weeklyOverviewDropdown"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="weeklyOverviewChart"></div>
          <div class="mt-1 mt-md-3">
            <div class="d-grid mt-3 mt-md-4">
              <button class="btn btn-primary" type="button">Details</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Weekly Overview Chart -->

    <!-- Data Tables -->
    <div class="col-8">
      <div class="card">
        <div class="table-responsive">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th class="text-truncate">User</th>
                <th class="text-truncate">Email</th>
                <th class="text-truncate">Verify</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-1 pe-1">
                        @if ($user->image == null)
                        <div class="avatar @if ($user->last_activity >= now()->subMinutes(1)) avatar-online @else @endif">
                            <div class="avatar-initial bg-label-primary rounded-circle">{{ Str::limit(ucwords($user->name), 1, '') }}</div>
                        </div>
                        @else
                        <div class="avatar @if ($user->last_activity >= now()->subMinutes(1)) avatar-online @else @endif">
                            <img src="{{ asset('backend/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">{{ $user->name }}</h6>
                      @foreach ($user->roles as $role)
                          <small class="text-muted">{{ $role->name }}</small>
                      @endforeach
                    </div>
                  </div>
                </td>
                <td class="text-truncate">{{ $user->email }}</td>
                <td>
                    @if ($user->is_verified == "1")
                        <span class="badge bg-label-success">Verified</span>
                    @else
                        <span class="badge bg-label-danger">Unverified</span>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--/ Data Tables -->
  </div>
@endsection
