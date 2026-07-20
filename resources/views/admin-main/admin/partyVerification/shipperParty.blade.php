@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">MANAGE Varification</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('/')}}">Go Back</a>
</div>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Shipper Party Verification</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end"
                          method="POST"
                          action="{{ route('party.varification.store') }}">
                    
                        @csrf
                    
                        <div class="mb-3">
                            <h3>Give Permission For Add New Party Without Documents</h3>
                        </div>
                    
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="toggleStatus"
                                   name="allow_without_docs"
                                   value="1"
                                   {{ isset($record) && $record->isFeatured == '1' ? 'checked' : '' }}
                                   >
                            <label class="form-check-label" for="toggleStatus" id="EnableDisable">
                                {{ (isset($record) && $record->isFeatured == '1') ? 'Switch to Disable' : 'Switch to Enable' }}
                            </label>
                        </div>
                    
                        <!--<button type="submit" class="btn btn-primary">-->
                        <!--    Save Permission-->
                        <!--</button>-->
                    </form>

                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table" id="example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Party Name</th>
                                    <th>Download</th>
                                    <th style="text-align: start;">Approval</th>
                                    <th style="text-align: start;">Approved/Updated By</th>
                                    <!--<th>Action</th>-->
                                 
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($ShipperPartyLists as $ShipperPartyList) 
                                    <tr>
                                        <td> {{$loop->iteration}}</td>
                                        <td> {{$ShipperPartyList->party_name}}</td>
                                        <td>
                                            @if($ShipperPartyList->document)
                                                <select class="form-control"
                                                        onchange="if(this.value) window.open(this.value, '_blank')">
                                                    <option value="">Select document</option>
                                                
                                                    @foreach($ShipperPartyList->document as $doc)
                                                        <option value="{{ asset('storage/app/public/'.$doc['path']) }}">
                                                            {{ $doc['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span class="text-muted">No document</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form class="row"
                                              method="POST"
                                              action="{{ route('party.approval.permission', $ShipperPartyList->id) }}">
                                            @csrf
                                            <input type="hidden" value="shipperParty" name="party_type" />
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input approvalStatus"
                                                       type="checkbox"
                                                       name="approval_status"
                                                       value="1"
                                                       {{ isset($ShipperPartyList) && $ShipperPartyList->approval == '1' ? 'checked' : '' }}
                                                       >
                                            </div>
                                            </form>
                                        </td>
                                        <td style="text-align: start;"> {{$ShipperPartyList->approvedBy->name??''}}</td>
                                    </tr>
                                
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {!! $ShipperPartyLists->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        document.getElementById('toggleStatus').addEventListener('change', function () {
            var isChecked = this.checked; // true / false

            if (isChecked) {
                document.getElementById('EnableDisable').innerText = 'Disable Permission';
            } else {
                document.getElementById('EnableDisable').innerText = 'Enable Permission';
            }
            this.form.submit();
        });
        
        document.querySelectorAll('.approvalStatus').forEach(function (btn) {
            btn.addEventListener('change', function () {
                this.form.submit();
            });
        });
    </script>
 
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
    
    

@endpush