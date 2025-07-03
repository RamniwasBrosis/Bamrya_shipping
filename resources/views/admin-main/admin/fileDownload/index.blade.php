@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Upload Download File</h5>
            </li>
        </ol>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="col-xl-6 col-sm-6 col-lg-4 m-3">
                        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="pdf_file" class="form-control" required>
                            <button type="submit" class="btn btn-primary mt-3 btn-sm">UPLOAD FILE</button>
                        </form>
                    </div>
                    
                    <div class="card-header d-block pb-2">
                        <form class="row align-items-end" method="GET" action="{{route('files.index')}}">
                            <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                                <label class="form-label">Find File</label><span
                                class="text-danger">*</span>
                                <select id="locationFilter" name="file_name" class="form-control default-select">
                                    <option value="">select</option>
                                    @foreach ($filters as $filter)
                                        <option value="{{$filter->file_name}}">{{$filter->file_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2 col-sm-6 col-lg-4 mb-3">
                                <button id="applyFilter" class="btn btn-primary" type="submit">Search</button>
                               <a href="{{route('files.index')}}" class="btn btn-danger">Reset</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0">

                        @if(session('success'))
                            <div class="alert alert-success px-3">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive active-projects style-1">
                            <table id="empoloyees-tblwrapper" class="table">
                                <thead>
                                    <tr>
                                        <th>File Id</th>
                                        <th>File Name</th>
                                        <th>Download PDF</th>
                                        <th>Delete PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>{{ $file->id }}</td>
                                            <td>{{ $file->file_name }}</td>
                                            <td>
                                                <a href="{{ route('files.download', $file->id) }}" class="text-success">Download</a>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('files.destroy', $file->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-danger light border-0">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($files->isEmpty())
                                        <tr>
                                            <td colspan="4">No files found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{$files->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection