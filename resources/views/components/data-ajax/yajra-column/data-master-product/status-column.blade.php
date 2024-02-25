@if ($model->status == 'active')
    <span class="badge bg-label-success">ACTIVE</span>
@else
    <span class="badge bg-label-danger">INACTIVE</span>
@endif