<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="bc-questions-table">
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th>Fact</th>
                    <th colspan="1">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bcResults as $bcResult)
                    <tr>
                        <th colspan="3" class="bg-light"> Result: {{ $bcResult->name }}</th>
                    </tr>
                    @foreach ($bcResult->bcQuestions as $bcQuestion)
                        <tr>
                            <td>{{ $bcQuestion->question }}</td>
                            <td>{{ $bcQuestion->bcFact->name }}</td>
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
