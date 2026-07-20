@if($sea_export->isNotEmpty())
<h5 class="mb-3 text-danger">Sea Export — Complate Operation </h5>
<ul class="list-group mb-4">
@foreach($sea_export as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <strong>FullJobNumber:: {{ $item->seaExport->jobMaster->full_job_no ?? 'N/A' }} | Shipper: {{ $item->seaExport->shipperName->party_name ?? '' }}</strong>
        </div>

        <!--<a href="{{ route('sea-exports.edit', $item->seaExport->uuid) }}" class="btn btn-primary btn-sm">-->
        <!--    Open Job-->
        <!--</a>-->
    </li>
@endforeach
</ul>
@endif




@if($sea_import->isNotEmpty())
<h5 class="mt-4 mb-3 text-danger">Sea Import — Complate Operation </h5>
<ul class="list-group">
@foreach($sea_import as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <strong>FullJobNumber: {{ $item->seaImport->jobMaster->full_job_no ?? '' }} | Consignee: {{ $item->seaImport->consignee->party_name ?? '' }}</strong>
        </div>
    </li>
@endforeach
</ul>
@endif





@if($air_export->isNotEmpty())
<h5 class="mt-4 mb-3 text-danger">Air Export — Complate Operation </h5>
<ul class="list-group">
@foreach($air_export as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <strong>FullJobNumber::  {{ $item->jobMaster->full_job_no ?? '' }} | Shipper: {{ $item->shipperName->party_name ?? '' }}</strong>

        <!--<span>Container: </span>-->

        <!--<a href="{{ route('air-exports.edit', $item->uuid) }}" class="btn btn-success btn-sm">-->
        <!--    Open Job-->
        <!--</a>-->
    </li>
@endforeach
</ul>
@endif





@if($air_import->isNotEmpty())
<h5 class="mt-4 mb-3 text-danger">Air Import — Complate Operation </h5>
<ul class="list-group">
@foreach($air_import as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <strong>FullJobNumber::  {{ $item->jobMaster->full_job_no ?? '' }} | Consignee: {{ $item->ConsigneeName->party_name ?? '' }}</strong>
    </li>
@endforeach
</ul>
@endif
