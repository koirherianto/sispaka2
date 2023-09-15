<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="facts-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Code Name</th>
                <th>Value Fact</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($facts as $fact)
                <tr>
                    <td>{{ $fact->name }}</td>
                    <td>{{ $fact->code_name }}</td>
                    <td>{{ $fact->value_fact }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['facts.destroy', $fact->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('facts.show', [$fact->id]) }}"
                               class='btn btn-success btn-xs'>
                                Show
                            </a>
                            <a href="{{ route('facts.edit', [$fact->id]) }}"
                               class='btn btn-warning btn-xs'>
                                Edit
                            </a>
                            {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $facts])
        </div>
    </div>
</div>
