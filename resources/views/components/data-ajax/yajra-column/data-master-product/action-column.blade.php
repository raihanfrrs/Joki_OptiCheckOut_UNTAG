<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editProduct" data-bs-toggle="modal" id="button-trigger-modal-edit-product" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.product.destroy', $model->id) }}" method="post" class="form-delete-product-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-product">
            <i class="ti ti-trash ti-sm mx-1"></i>
        </a>
    </form>
    <form action="{{ route('master.product.update.status', $model->id) }}" method="post">
        @csrf
        @method('PATCH')
        @if ($model->status == 'active')
            <button type="submit" class="bg-transparent border-0 text-body">
                <i class="ti ti-square-x ti-sm"></i>
            </button>
        @else
            <button type="submit" class="bg-transparent border-0 text-body">
                <i class="ti ti-square-check ti-sm"></i>
            </button>
        @endif
    </form>
</div>