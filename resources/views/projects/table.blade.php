<div class="card-body p-0">
    <div class="table-responsive">
        <div class="card-body p-2">
            <div class="row">
                {{-- jika project kosong --}}
                @if (count($projects) == 0)
                    <div class="col-md-12">
                        <div class="alert alert-info" style="text-align: center;">
                            <p>You don't have a project yet</p>
                            <a href="{{ route('projects.create') }}">
                                <p class="btn btn-light">Create a Project.</p>
                            </a>
                        </div>
                    </div>
                @endif
                @foreach ($projects as $project)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ $project->title }}</h5>
                            </div>
                            <div class="card-body">
                                @role('super-admin')
                                    <p class="card-text">
                                        <strong>User:</strong>
                                        @foreach ($project->users as $user)
                                            {{ $user->name }}
                                            @if (!$loop->last)
                                                , {{-- Mencegah tanda koma di akhir daftar --}}
                                            @endif
                                        @endforeach
                                    </p>
                                @endrole

                                <p class="card-text">
                                    <strong>Method:</strong>
                                    @foreach ($project->methods as $method)
                                        {{ $method->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>

                                <p class="card-text">
                                    <strong>Status Publish:</strong> {{ $project->status_publish }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group">
                                    <a href="{{ route('projects.show', [$project->id]) }}"
                                        class="btn btn-success btn-sm">
                                        Show
                                    </a>
                                    <a href="{{ route('projects.edit', [$project->id]) }}"
                                        class="btn btn-warning btn-sm ml-1">
                                        Setting
                                    </a>
                                    <a href="{{ route('projects.edit', [$project->id]) }}"
                                        class="btn btn-info btn-sm ml-1">
                                        Contributor
                                    </a>
                                </div>
                                <div class="btn-group mt-2">
                                    <!-- Switch Button -->
                                    {!! Form::open(['route' => ['changeProject', $project->id], 'method' => 'post']) !!}
                                    {!! Form::button(Auth::user()->session_project == $project->id ? 'Manage' : 'Manage', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-sm ' . (Auth::user()->session_project == $project->id ? 'btn-muted' : 'btn-dark'),
                                        'onclick' => "return confirm('Are you sure?')",
                                    ]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
                                    {!! Form::button('Delete', [
                                        'type' => 'submit',
                                        'class' => 'ml-1 btn btn-danger btn-sm',
                                        'onclick' => "return confirm('Are you sure?')",
                                    ]) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


        </div>

    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $projects])
        </div>
    </div>
</div>
