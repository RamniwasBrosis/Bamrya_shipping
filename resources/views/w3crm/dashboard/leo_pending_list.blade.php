@if($sea_export->isNotEmpty())
<h5 class="mb-3 text-danger">Sea Export — Pending LEO Dates </h5>
<ul class="list-group mb-4">
@foreach($sea_export as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <strong>FullJobNumber:: {{ $item->seaExport->jobMaster->full_job_no ?? 'N/A' }} | 
            <span> Container: {{ $item->container_no }} | </span>
            <span> Shipper: {{ $item->seaExport->shipperName->party_name ?? '' }}</span> </strong>
        </div>

        <a href="{{ route('sea-exports.edit', $item->seaExport->uuid) }}" class="btn btn-primary btn-sm">
            Open Job
        </a>
    </li>
@endforeach
</ul>
@endif

@if($sea_import->isNotEmpty())
<h5 class="mt-4 mb-3 text-danger">Sea Import — Pending Out Of Charge (OOC) Dates </h5>
<ul class="list-group">
@foreach($sea_import as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <strong>FullJobNumber: {{ $item->seaImport->jobMaster->full_job_no ?? 'N/A' }} |
            <span> Container::  {{ $item->container_no }} |</span>
            <span> Consignee: {{ $item->seaImport->consignee->party_name ?? '' }}</span> </strong>
        </div>

        <a href="{{ route('sea-imports.edit', $item->seaImport->uuid) }}" class="btn btn-success btn-sm">
            Open Job
        </a>
    </li>
@endforeach
</ul>
@endif

@if($air_export->isNotEmpty())
<h5 class="mt-4 mb-3 text-danger">Air Export — Pending LEO Dates </h5>
<ul class="list-group">
@foreach($air_export as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <strong>FullJobNumber:  {{ $item->jobMaster->full_job_no ?? 'N/A' }} | Shipper: {{ $item->shipperName->party_name ?? '' }}</strong>

        <!--<span>Container: </span>-->

        <a href="{{ route('air-exports.edit', $item->uuid) }}" class="btn btn-success btn-sm">
            Open Job
        </a>
    </li>
@endforeach
</ul>
@endif

@if($air_import->isNotEmpty())
<h5 class="mt-4 mb-3 text-danger">Air Import — Pending Out Of Charge (OOC) Dates </h5>
<ul class="list-group">
@foreach($air_import as $item)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <strong>FullJobNumber::  {{ $item->jobMaster->full_job_no ?? 'N/A' }} | Consignee: {{ $item->ConsigneeName->party_name ?? '' }}</strong>

        <!--<span>Container: </span>-->

        <a href="{{ route('air-imports.edit', $item->uuid) }}" class="btn btn-success btn-sm">
            Open Job
        </a>
    </li>
@endforeach
</ul>
@endif
