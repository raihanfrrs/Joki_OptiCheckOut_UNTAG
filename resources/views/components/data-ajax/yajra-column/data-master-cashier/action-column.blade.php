<div class="d-flex justify-content-center">
    <a href="{{ route('master.cashier.edit', $model->id) }}" class="text-body"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.cashier.destroy', $model->id) }}" method="post" class="form-delete-cashier-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-cashier">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('master.cashier.show', $model->id) }}" target="_blank" class="dropdown-item">Rincian</a>
        <form action="{{ route('master.cashier.update.status', $model->id) }}" method="post">
            @csrf
            @method('PATCH')
            <button type="submit" class="bg-transparent border-0 text-body dropdown-item">{{ $model->status == 'active' ? 'Nonaktif' : 'Aktif' }}</button>
        </form>
    </div>
</div>