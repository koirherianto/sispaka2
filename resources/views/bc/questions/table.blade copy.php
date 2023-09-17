<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="bc-questions-table">
            <thead>
                <tr>
                    <th>Bc Result => </th>
                    <th>Bc Fact </th>
                    <th>Question</th>
                    <th>Code Name</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bcQuestions as $bcQuestion)
                    <tr>
                        <td>{{ $bcQuestion->bcFact->name }}</td>
                        <td>{{ $bcQuestion->bcResult->name }}</td>
                        <td>{{ $bcQuestion->question }}</td>
                        <td>{{ $bcQuestion->code_name }}</td>
                        <td style="width: 120px">
                            <div class='btn-group'>
                                <a href="{{ route('bcQuestions.show', [$bcQuestion->id]) }}"
                                    class="btn btn-success btn-sm">
                                    Show
                                </a>
                                <a href="{{ route('bcQuestions.edit', [$bcQuestion->id]) }}"
                                    class="btn btn-warning btn-sm ml-1">
                                    Edit
                                </a>
                                {!! Form::open(['route' => ['bcQuestions.destroy', $bcQuestion->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $bcQuestions])
        </div>
    </div>
</div>
