<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Container No</th>
            <th>Agent Seal No</th>
            <th>Size</th>
            <th>Gross Weight</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        @forelse($containerDetails as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->container_no }}</td>
                <td>{{ $row->agent_seal_no }}</td>
                <td>{{ $row->size }}</td>
                <td>{{ $row->cont_gross_weight }}</td>

                <td>
                    <button class="btn btn-sm btn-primary editContainerBtn"
                        data-id="{{ $row->id }}">
                        Edit
                    </button>
                </td>

                <td>
                    <button class="btn btn-sm btn-danger deleteContainerBtn"
                        data-id="{{ $row->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No Containers Added</td>
            </tr>
        @endforelse
    </tbody>
</table>
