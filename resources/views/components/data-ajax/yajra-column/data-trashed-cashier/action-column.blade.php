<div class="d-flex justify-content-center">
    <form action="{{ route('trash.cashier.update', $model->id) }}" method="post">
        @csrf
        @method('PATCH')
        <button type="submit" class="bg-transparent border-0 text-body">
            <i class="ti ti-rotate ti-sm mx-2"></i>
        </button>
    </form>
    <form action="{{ route('trash.cashier.destroy', $model->id) }}" method="post" class="form-delete-cashier-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-cashier">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
</div>