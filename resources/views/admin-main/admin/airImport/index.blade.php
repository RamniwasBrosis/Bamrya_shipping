@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Manage New MAWB</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/air-imports/create')}}">+ Add MAWB</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">MAWB DETAILS</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('air-imports.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By MAWB No.</label>
                            <select id="" class="form-control default-select select2" name="mawb_no">
                                <option value="">select</option> 
                                @foreach ($airImports as $airImport)
                                    <option value="{{$airImport->mawb_no}}">{{$airImport->mawb_no}}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By Job No.</label>
                            <select id="" class="form-control default-select select2" name="job_no">
                                <option value="">select</option>
                                @foreach ($airImports as $airImport)
                                    <option value="{{$airImport->job_no}}">{{$airImport->job_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">Search By HBL No.</label>
                            <select id="departmentFilter" class="form-control default-select select2" name="hbl_no">
                                <option value="">select</option> 
                                @foreach ($airImports as $airImport)
                                    <option value="{{$airImport->hbl_no}}">{{$airImport->hbl_no}}</option>
                                @endforeach                              
                            </select>
                        </div>                        
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('air-imports.index')}}" class="btn btn-danger light ms-2" type="button">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>MAWB No.</th>
                                    <th>JobNo</th>
                                    <th>HBL No</th>
                                    <th>MBL No</th>
                                    <th>MBL Date</th>
                                    <th>Full Job No</th>
                                    <th>IGM No</th>
                                    <th>Origin</th>
                                    <th>Dest</th>
                                    <th>Packages</th>
                                    <th>Weight</th>
                                    <th>finyear</th>
                                    <th>Username</th>
                                    <th>Shipment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($airImports as $airImport)
                                    @php
                                        $year = $airImport->created_at->format('Y');
                                        $month = $airImport->created_at->format('m');

                                        if ((int)$month < 4) {
                                            // If Jan-Mar, financial year is previous year
                                            $fyStart = $year - 1;
                                            $fyEnd = $year;
                                        } else {
                                            $fyStart = $year;
                                            $fyEnd = $year + 1;
                                        }

                                        $fy = $fyStart . '-' . substr($fyEnd, -2);
                                    @endphp
                                    <tr>
                                        <td>{{$airImport->id}}</td>
                                        <td>{{$airImport->mawb_no}}</td>
                                        <td>{{$airImport->job_no}}</td>
                                        <td>{{$airImport->hbl_no}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$airImport->igm_no}}</td>
                                        <td>{{$airImport->origin_port}}</td>
                                        <td>{{$airImport->dest_port}}</td>
                                        <td>{{$airImport->package}}</td>
                                        <td>{{$airImport->weight}}</td>
                                        <td>{{$fy}}</td>
                                        <td>{{$airImport->username}}</td>
                                        <td>{{$airImport->shipment}}</td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/air-imports/'.$airImport->uuid.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-air-import" href="javascript:void(0);" data-id="{{$airImport->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-air-import', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this Air Import?')) return;

            const airExportId = $(this).data('id');

            $.ajax({
                url: '/admin/air-imports/' + airExportId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                }
            });
        });
    </script>

@endpush