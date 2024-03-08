<div class="d-flex justify-content-center">
    <form action="{{ route('trash.category.update', $model->id) }}" method="post">
        @csrf
        @method('PATCH')
        <button type="submit" class="bg-transparent border-0 text-body">
            <i class="ti ti-rotate ti-sm mx-2"></i>
        </button>
    </form>
    <form action="{{ route('trash.category.destroy', $model->id) }}" method="post" class="form-delete-category-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-category">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
</div>