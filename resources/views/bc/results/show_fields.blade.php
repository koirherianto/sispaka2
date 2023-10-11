<!-- Backward Chaining Id Field -->
<div class="col-sm-12">
    {!! Form::label('backward_chaining_id', 'Backward Chaining:') !!}
    <p>{{ $bcResult->backwardChaining->project->title }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('user_maker', 'User Maker:') !!}
    <p>{{ $bcResult->usersMaker }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $bcResult->name }}</p>
</div>

<!-- Code Name Field -->
<div class="col-sm-12">
    {!! Form::label('code_name', 'Code Name:') !!}
    <p>{{ $bcResult->code_name }}</p>
</div>

@if ($bcResult->hasMedia('bc_result'))
    <div class="col-sm-12">
        {!! Form::label('image_description', 'Image Description:') !!}
        <p>{{ $bcResult->getMedia('bc_result')[0]->getCustomProperty('description') }}</p>
    </div>

    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('image', 'Image :') !!}
        <div class="">
            <img src="{{ $bcResult->getFirstMediaUrl('bc_result') }}"
                alt="{{ $bcResult->getMedia('bc_result')[0]->getCustomProperty('description') }}" 
                class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
        </div>
    </div>
@endif

<!-- Reason Field -->
<div class="col-sm-12">
    {!! Form::label('reason', 'Reason:') !!}
    <p>{{ $bcResult->reason }}</p>
</div>

<!-- Solution Field -->
<div class="col-sm-12">
    {!! Form::label('solution', 'Solution:') !!}
    <p>{{ $bcResult->solution }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $bcResult->created_at->format('d/m/Y H:i') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('updated_at', 'Diperbarui pada:') !!}
    <p>{{ $bcResult->updated_at->format('d/m/Y H:i') }}</p>
</div>
