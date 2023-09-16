<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="bc-facts-table">
            <thead>
                <tr>
                    @if (Auth::user()->hasRole('super-admin'))
                        <th>Backward Chaining </th>
                        <th>User Maker </th>
                    @endif
                    <th>Name</th>
                    <th>Code Name</th>
                    <th>Value Fact</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bcFacts as $bcFact)
                    <tr>
                        @if (Auth::user()->hasRole('super-admin'))
                            <td>{{ $bcFact->backwardChaining->project->title }}</td>
                            <td>{{ $bcFact->usersMaker }}</td>
                        @endif
                        <td>{{ $bcFact->name }}</td>
                        <td>{{ $bcFact->code_name }}</td>
                        <td>{{ $bcFact->value_fact }}</td>
                        <td style="width: 120px">
                            <div class='btn-group'>
                                <a href="{{ route('bcFacts.show', [$bcFact->id]) }}" class="btn btn-success btn-sm">
                                    Show
                                </a>
                                <a href="{{ route('bcFacts.edit', [$bcFact->id]) }}" class="btn btn-warning btn-sm ml-1">
                                    Edit
                                </a>
                                {!! Form::open(['route' => ['bcFacts.destroy', $bcFact->id], 'method' => 'delete']) !!}
                                {!! Form::button('Delete', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm ml-1',
                                        'onclick' => "return confirm('Are you sure?')",
                                    ]) !!}
                                {!! Form::close() !!}
                            </div>
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
