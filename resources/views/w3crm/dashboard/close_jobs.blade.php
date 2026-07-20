@if($jobs->isEmpty())
    <p class="text-center">No pending jobs!</p>
@else
    <ul class="list-group" style="overflow-y: scroll; max-height: 350px;">
        @foreach($jobs as $job)
             @php
                if(str_contains($job->job_activity, 'EXP')){
                    $partyName = 'Shipper: ' . ($job->shipperName->party_name ?? '-');
                }else{
                    $partyName = 'Consignee: ' . ($job->consigneeName->party_name ?? '-');
                }
            @endphp
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h5>{{ $job->job_number ?? 'Job -'.$job->full_job_no. ' || Job Date:' . $job->job_date }} || {{$partyName}}</h5>
                <!--<div class="d-flex gap-1">-->
                <!--    @if($job->job_activity == 'SEAIMP.FWD' || $job->job_activity == 'SEAIMP.NVOCC')-->
                <!--        <a href="{{ route('sea-imports.create', ['job_id' => $job->id]) }}" class="btn btn-sm btn-success">-->
                <!--            Close Sea Import Job-->
                <!--        </a>-->
                <!--    @elseif($job->job_activity == 'SEAEXP.FWD' || $job->job_activity == 'SEAEXP.NVOCC')-->
                <!--        <a href="{{ route('sea-exports.create', ['job_id' => $job->id]) }}" class="btn btn-sm btn-success">-->
                <!--            Close Sea Export Job-->
                <!--        </a>-->
                <!--    @elseif($job->job_activity == 'AIRIMP.FWD')-->
                <!--        <a href="{{ route('air-imports.create', ['job_id' => $job->id]) }}" class="btn btn-sm btn-success">-->
                <!--            Close Air Import Job-->
                <!--        </a>-->
                <!--    @elseif($job->job_activity == 'AIREXP.FWD')-->
                <!--        <a href="{{ route('air-exports.create', ['job_id' => $job->id]) }}" class="btn btn-sm btn-success">-->
                <!--            Close Air Export Job-->
                <!--        </a>-->
                <!--    @endif-->
                <!--</div>-->
            </li>
        @endforeach
    </ul>
@endif