<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="contributors-table">
            <thead>
                <tr>
                    <th>Have Account</th>
                    <th>Name</th>
                    <th>Contribution</th>
                    <th>Email</th>
                    <th>Link</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contributors as $contributor)
                    <tr>
                        <td>{{ $contributor->user_id ? 'Yes' : 'No' }}</td>
                        <td>{{ $contributor->name }}</td>
                        <td>{{ $contributor->contribution }}</td>
                        <td>{{ $contributor->email }}</td>
                        <td>{{ $contributor->link }}</td>
                        <td style="width: 120px">
                            <div class='btn-group'>
                                <a href="{{ route('contributors.show', [$contributor->id]) }}"
                                    class="btn btn-success btn-sm">
                                    Show
                                </a>
                                <a href="{{ route('contributors.edit', [$contributor->id]) }}"
                                    class="btn btn-warning btn-sm ml-1">
                                    Edit
                                </a>
                                {!! Form::open(['route' => ['contributors.destroy', $contributor->id], 'method' => 'delete']) !!}
                                {!! Form::button('Delete', [
                                    'type' => 'submit',
                                    'class' => 'ml-1 btn btn-danger btn-sm',
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
            @include('adminlte-templates::common.paginate', ['records' => $contributors])
        </div>
    </div>
</div>
