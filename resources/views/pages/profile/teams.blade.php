<div class="row g-4">
    @foreach ($teams as $team)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="dropdown btn-pinned">
              <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical text-muted"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('master.cashier.show', $team->id) }}">Detail</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('master.cashier.destroy', $team->id) }}" method="POST" class="d-inline">
                        <a class="dropdown-item text-danger" href="javascript:void(0);" id="button-delete-cashier" data-id="{{ $team->id }}">Delete</a>
                    </form>
                </li>
              </ul>
            </div>
            <div class="mx-auto my-3">
              <img src="{{ asset($team->getFirstMediaUrl('cashier_images')) }}" alt="Avatar Image" class="rounded-circle w-px-100">
            </div>
            <h4 class="mb-1 card-title text-capitalize">{{ $team->first_name . ' ' . $team->last_name }}</h4>
            <span class="pb-1 text-capitalize">{{ $team->user->level }}</span>
  
            <div class="d-flex align-items-center justify-content-around my-3 py-1">
              <div>
                <h4 class="mb-0">{{ $team->transaction->count() }}</h4>
                <span>Task Completed</span>
              </div>
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>