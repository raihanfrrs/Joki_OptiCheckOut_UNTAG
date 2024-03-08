<div class="d-flex justify-content-center">
    <form action="{{ route('trash.product.update', $model->id) }}" method="post">
        @csrf
        @method('PATCH')
        <button type="submit" class="bg-transparent border-0 text-body">
            <i class="ti ti-rotate ti-sm mx-2"></i>
        </button>
    </form>
    <form action="{{ route('trash.product.destroy', $model->id) }}" method="post" class="form-delete-product-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-product">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
</div>