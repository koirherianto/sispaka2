<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="bc-results-table">
            <thead>
            <tr>
                <th>Backward Chaining Id</th>
                <th>Name</th>
                <th>Code Name</th>
                <th>Reason</th>
                <th>Solution</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bcResults as $bcResult)
                <tr>
                    <td>{{ $bcResult->backward_chaining_id }}</td>
                    <td>{{ $bcResult->name }}</td>
                    <td>{{ $bcResult->code_name }}</td>
                    <td>{{ $bcResult->reason }}</td>
                    <td>{{ $bcResult->solution }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['bcResults.destroy', $bcResult->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('bcResults.show', [$bcResult->id]) }}"
                               class="btn btn-success btn-sm">
                                        Show
                            </a>
                            <a href="{{ route('bcResults.edit', [$bcResult->id]) }}"
                               class="btn btn-warning btn-sm ml-1">
                                        Edit
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $bcResults])
        </div>
    </div>
</div>
