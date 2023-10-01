<div class="col-sm-12">
    {!! Form::label('user_id', 'User ') !!}
    <p>
        @foreach ($project->users as $user)
            {{ $user->name }}
            @if (!$loop->last)
                , {{-- Mencegah tanda koma di akhir daftar --}}
            @endif
        @endforeach
    </p>
</div>

<div class="col-sm-12">
    {!! Form::label('Method', 'Method:') !!}
    <p>
    @foreach ($project->methods as $method)
        {{ $method->name }}
        @if (!$loop->last)
            ,
        @endif
    @endforeach
    </p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $project->title }}</p>
</div>

<!-- Status Publish Field -->
<div class="col-sm-12">
    {!! Form::label('status_publish', 'Status Publish:') !!}
    <p>{{ $project->status_publish }}</p>
</div>

@if ($project->hasMedia('image_project'))
    <div class="col-sm-12">
        {!! Form::label('image_description', 'Image Description:') !!}
        <p>{{ $project->getMedia('image_project')[0]->getCustomProperty('description') }}</p>
    </div>

    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('image', 'Image :') !!}
        <div class="">
            <img src="{{ $project->getFirstMediaUrl('image_project') }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
        </div>
    </div>
@endif

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $project->created_at->format('d/m/Y') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $project->updated_at->format('d/m/Y') }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <div>{!! html_entity_decode($project->description) !!}</div>
    {{-- <p>{{ $project->description }}</p> --}}
</div>
