<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="projects-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Status Publish</th>
                <th>Institution</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->status_publish }}</td>
                    <td>{{ $project->institution }}</td>
                    <td>{{ $project->description }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projects.show', [$project->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projects.edit', [$project->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projects])
        </div>
    </div>
</div>
