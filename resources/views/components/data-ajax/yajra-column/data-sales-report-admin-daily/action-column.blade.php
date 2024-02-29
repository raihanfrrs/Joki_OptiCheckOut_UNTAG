<div class="d-flex justify-content-center">
    <a href="{{ route('admin.sales.report.daily.print', \Carbon\Carbon::parse($model->period)->format('d-m-Y')) }}" class="text-body" target="_blank"><i class="ti ti-printer ti-sm mx-1"></i></a>
</div>