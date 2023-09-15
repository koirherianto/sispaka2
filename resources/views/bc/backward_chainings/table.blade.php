<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="backward-chainings-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($backwardChainings as $backwardChaining)
                <tr>
                    <td>{{ $backwardChaining->project_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['backwardChainings.destroy', $backwardChaining->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('backwardChainings.show', [$backwardChaining->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('backwardChainings.edit', [$backwardChaining->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $backwardChainings])
        </div>
    </div>
</div>
