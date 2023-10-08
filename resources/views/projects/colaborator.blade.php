@extends('layouts.app')

@section('content')
    <div class="content px-3">
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="card mt-3">
            <div class="card-header ">
                Colaboration
                <a href="#" class="btn btn-dark btn-sm float-right" data-toggle="modal"
                    data-target="#addColaboratorModal">Add Colaborator</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {!! Form::open(['route' => 'deleteColaborator', 'method' => 'delete']) !!}
                                    <input type="hidden" value="{{ $project->id }}" name="project_id">
                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    {!! Form::button('Delete', [
                                        'type' => 'submit',
                                        'class' => 'ml-1 btn btn-danger btn-sm',
                                        'onclick' => "return confirm('Are you sure?')",
                                    ]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Kolaborator -->
    <div class="modal fade" id="addColaboratorModal" tabindex="-1" role="dialog"
        aria-labelledby="addColaboratorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColaboratorModalLabel">Tambah Kolaborator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'tambahColaborator', 'method' => 'post']) !!}
                    <input type="hidden" value="{{ $project->id }}" name="project_id">
                    <div class="form-group">
                        <label for="email">Email Kolaborator</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan email kolaborator" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    {!! Form::submit('Tambah', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
