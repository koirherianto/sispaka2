<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="permisions-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Guard Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permisions as $permision)
                <tr>
                    <td>{{ $permision->name }}</td>
                    <td>{{ $permision->guard_name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['permisions.destroy', $permision->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('permisions.show', [$permision->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('permisions.edit', [$permision->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $permisions])
        </div>
    </div>
</div>
