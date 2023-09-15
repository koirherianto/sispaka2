<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="bc-facts-table">
            <thead>
            <tr>
                <th>Backward Chaining Id</th>
                <th>Name</th>
                <th>Code Name</th>
                <th>Value Fact</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bcFacts as $bcFact)
                <tr>
                    <td>{{ $bcFact->backward_chaining_id }}</td>
                    <td>{{ $bcFact->name }}</td>
                    <td>{{ $bcFact->code_name }}</td>
                    <td>{{ $bcFact->value_fact }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['bcFacts.destroy', $bcFact->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('bcFacts.show', [$bcFact->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('bcFacts.edit', [$bcFact->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
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
            @include('adminlte-templates::common.paginate', ['records' => $bcFacts])
        </div>
    </div>
</div>
