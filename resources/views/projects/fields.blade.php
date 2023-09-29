

@role('super-admin')
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'User:') !!}
        {!! Form::select('user_id', $users->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
    </div>
@endrole

@role('individual')
    <input type="hidden" value="-" name="user_id">
@endrole

@if ($isEditPage)
    <div class="form-group col-sm-6">
        {!! Form::label('status_publish', 'Status Publish') !!}
        {!! Form::select(
            'status_publish',
            ['publish' => 'Publish', 'not_publish' => 'Not Publish'],
            $project->status_publish,
            ['class' => 'form-control'],
        ) !!}
    </div>
@else
    <input type="hidden" value="-" name="status_publish">
@endif

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 100,
    ]) !!}
</div>

<input type="hidden" value="-" name="slug">

<!-- short_description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('short_description', 'Utility Description: Maxi 160 characters' ) !!}
    {!! Form::text('short_description', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 160,
    ]) !!}
</div>

<!-- tag_keyword Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag_keyword', 'Tag Keyword: Pisahkan dengan koma') !!}
    {!! Form::text('tag_keyword', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 160,
        'placeholder' => ' Contoh: sistem pakar, penyakit pada jagung ... ',
    ]) !!}
</div>

@if (!$isEditPage)
<!-- Method -->
    <div class="form-group col-sm-7">
        {!! Form::label('method_id', 'Method: (its cannot change later)') !!}
        @foreach ($methods as $method)
            <div class="form-check">
                {!! Form::checkbox('method_ids[]', $method->id, false, ['class' => 'form-check-input', 'id' => 'method_id_'.$method->id]) !!}
                {!! Form::label('method_id_'.$method->id, $method->name, ['class' => 'form-check-label']) !!}
            </div>
        @endforeach
    </div>
@endif

<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Blog: - Jangan Pakai Judul') !!}
    <textarea name="description" id="description" class="form-control">
        {!! isset($project) ? $project->description : '' !!}
    </textarea>
</div>


<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        disallowedContent: 'h1'
    });
</script>

{{-- <script>
    CKEDITOR.replace('description', {
        allowedContent: 'p[!class];'
    });
</script> --}}
