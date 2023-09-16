<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="bc-results-table">
            <thead>
                <tr>
                    @if (Auth::user()->hasRole('super-admin'))
                        <th>Backward Chaining </th>
                        <th>User Maker </th>
                    @endif
                    <th>Name</th>
                    <th>Code Name</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bcResults as $bcResult)
                    <tr>
                        @if (Auth::user()->hasRole('super-admin'))
                            <td>{{ $bcResult->backwardChaining->project->title }}</td>
                            <td>{{ $bcResult->usersMaker }}</td>
                        @endif
                        <td>{{ $bcResult->name }}</td>
                        <td>{{ $bcResult->code_name }}</td>
                        <td style="width: 120px">
                            <div class='btn-group'>
                                <a href="{{ route('bcResults.show', [$bcResult->id]) }}" class="btn btn-success btn-sm">
                                    Show
                                </a>
                                <a href="{{ route('bcResults.edit', [$bcResult->id]) }}"
                                    class="btn btn-warning btn-sm ml-1">
                                    Edit
                                </a>
                                {!! Form::open(['route' => ['bcResults.destroy', $bcResult->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $bcResults])
        </div>
    </div>
</div>
