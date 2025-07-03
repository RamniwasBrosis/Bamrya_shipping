@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Edit Job Open CLose</h5>
            </li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/JobOpenclose') }}"><- Go Back</a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="mb-6 row">
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="lcl">
                            <label class="form-check-label" for="lcl">
                                Air Import
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="fcl20">
                            <label class="form-check-label" for="fcl20">
                                Air Export
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="fcl40">
                            <label class="form-check-label" for="fcl40">
                                Sea Import
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="air">
                            <label class="form-check-label" for="air">
                                Sea Export
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">JOB STATUS:</label>
                    <div class="col-sm-9 d-flex align-items-center">
                        <select class="default-select form-control wide me-2" placeholder="Select"></select>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label class="col-sm-3 col-form-label">Full Job No:</label>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center">
                            <select class="form-control me-2" placeholder="Select"></select>
                            <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                <i class="bi bi-search me-1"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary btn-sm">UPDATE</button><br>
                <br>
            </div>
        </div>
        </form>
        <div class="card-body p-0">
            <div class="table-responsive active-projects style-1">
                <table id="empoloyees-tblwrapper" class="table">
                    <thead>
                        <tr>
                            <th>Select All</th>
                            <th>Job No</th>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Open/Close</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Select</td>
                            <td>AI/1693/FEB/2023-24</td>
                            <td>07/02/2024</td>
                            <td>AI</td>
                            <td>Open</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
@endsection
