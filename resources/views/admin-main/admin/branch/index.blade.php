@extends('admin-main.layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li><h5 class="bc-title">Manage Branch</h5></li>
    </ol>
    <a class="text-primary fs-13" href="{{url('admin/branches/create')}}">+ Add Branch</a>
</div>

<div id="Smsg" class="my-5 text-success" style="display: none; "></div>
<div id="Emsg" class="my-5 text-success" style="display: none; "></div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 d-sm-flex d-block">
                    <h4 class="card-title mb-2">Branch Details</h4>
                </div>
                <div class="card-header d-block pb-2">
                    <form class="row align-items-end" method="get" action="{{route('branches.index')}}">
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by branch code</label>
                            <select id="statusFilter" class="form-control default-select" name="branch_code">
                                <option value="">select</option>
                                @foreach ($branchCodes as $branchCode)
                                    <option value="{{$branchCode->branch_code}}">{{$branchCode->branch_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <label class="form-label">search by branch code</label>
                            <select id="statusFilter" class="form-control default-select" name="branch_name">
                                <option value="">select</option>
                                @foreach ($branchNames as $branchName)
                                    <option value="{{$branchName->branch_name}}">{{$branchName->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                            <button id="applyFilter" class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{route('branches.index')}}" class="btn btn-danger light ms-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>Branch Code</th>
                                    <th>Branch Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branche)
                                    <tr>
                                        <td>{{$branche->branch_code}}</td>
                                        <td>{{$branche->branch_name}}</td>
                                        <td>
                                            @if ($branche->status == 1)
                                                <aspan class="badge badge-success light border-0">Active</span>
                                            @else
                                                <aspan class="badge badge-danger light border-0"> In-active</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <a class="badge badge-info light border-0" href="{{url('admin/branches/'.$branche->id.'/edit')}}">Edit</a>
                                            <a class="badge badge-danger light border-0 delete-branch" href="javascript:void(0);" data-id="{{$branche->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $branches->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-branch', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this branch?')) return;

            const branchId = $(this).data('id');

            $.ajax({
                url: '/admin/branches/' + branchId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#Smsg').css('display', 'block').text('company record deleted successfully.');
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }

                    $('#Emsg').css('display', 'block').text(errorMessage);
                }
            });
        });
    </script>

@endpush