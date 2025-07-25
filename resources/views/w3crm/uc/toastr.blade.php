@extends('layouts.default')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Plugins</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Toastr</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Toastr</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-dark mb-2 me-2" id="toastr-success-top-right">Top
                        Right</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-bottom-right">Bottom Right</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-bottom-left">Bottom Left</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-top-left">Top
                        Left</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-top-full-width">Top Full Width</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-bottom-full-width">Bottom Full Width</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-top-center">Top
                        Center</button>
                    <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-bottom-center">Bottom Center</button>
                    <button type="button" class="btn btn-info mb-2  me-2" id="toastr-info-top-right">Info</button>
                    <button type="button" class="btn btn-warning mb-2  me-2" id="toastr-warning-top-right">Warning</button>
                    <button type="button" class="btn btn-danger mb-2  me-2" id="toastr-danger-top-right">Error</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
