<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editCategory" data-bs-toggle="modal" id="button-trigger-modal-edit-category" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.category.destroy', $model->id) }}" method="post" class="form-delete-category-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-category">
            <i class="ti ti-trash ti-sm mx-1"></i>
        </a>
    </form>
</div>