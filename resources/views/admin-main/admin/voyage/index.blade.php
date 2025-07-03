@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE VOYAGE</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/voyages/create')}}">+ Add voyage</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">voyage</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Voyage Code</th>
                                    <th>Voyage Number</th>
                                    <th>M Vessel Name</th>
                                    <th>Arrival Date</th>
                                    <th>IGM Number</th>
                                    <th>IGM Date</th>
                                    <th>Shipping Line</th>
                                    <th>F Voyage No</th>
                                    <th>F Vessel Name</th>
                                    <th>Mumbai IGM No</th>
                                    <th>Mumbai IGM Date</th>
                                    <th>Overseas Agent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($MasterVoyages as $MasterVoyage)
                                    <tr>
                                        <td>{{$MasterVoyage->voyage_code}}</td>
                                        <td>{{$MasterVoyage->voyage_number}}</td>
                                        <td>{{$MasterVoyage->m_vessel_id}}</td>
                                        <td>{{$MasterVoyage->arrival_date}}</td>
                                        <td>{{$MasterVoyage->igm_number}}</td>
                                        <td>{{$MasterVoyage->igm_date}}</td>
                                        <td>{{$MasterVoyage->shipping_line_id}}</td>
                                        <td>{{$MasterVoyage->f_voyage_no}}</td>
                                        <td>{{$MasterVoyage->f_vessel_id}}</td>
                                        <td>{{$MasterVoyage->mumbai_igm_no}}</td>
                                        <td>{{$MasterVoyage->mumbai_igm_date}}</td>
                                        <td>{{$MasterVoyage->overseas_agent_id}}</td>
                                        <td>
                                            @if ($MasterVoyage->status == 1)
                                                <span class="badge badge-success light border-0">Active</span>                                                
                                            @else
                                                <span class="badge badge-danger light border-0">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/voyages/'.$MasterVoyage->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-voyage" href="javascript:void(0);" data-id="{{$MasterVoyage->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $MasterVoyages->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-voyage', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this voyage?')) return;

            const voyageId = $(this).data('id');

            $.ajax({
                url: '/admin/voyages/' + voyageId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('voyage deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete voyage.');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

@endpush