<!-- Backward Chaining Id Field -->
<div class="col-sm-12">
    {!! Form::label('backward_chaining_id', 'Backward Chaining:') !!}
    <p>{{ $bcFact->backwardChaining->project->title }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('user_maker', 'User Maker:') !!}
    <p>{{ $bcFact->usersMaker }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $bcFact->name }}</p>
</div>

<!-- Code Name Field -->
<div class="col-sm-12">
    {!! Form::label('code_name', 'Code Name:') !!}
    <p>{{ $bcFact->code_name }}</p>
</div>

@if ($bcFact->hasMedia('bc_fact'))
    <div class="col-sm-12">
        {!! Form::label('image_description', 'Image Description:') !!}
        <p>{{ $bcFact->getMedia('bc_fact')[0]->getCustomProperty('description') }}</p>
    </div>

    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('image', 'Image :') !!}
        <div class="">
            <img src="{{ $bcFact->getFirstMediaUrl('bc_fact') }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
        </div>
    </div>
@endif

<!-- Value Fact Field -->
<div class="col-sm-12">
    {!! Form::label('value_fact', 'Value Fact:') !!}
    <p>{{ $bcFact->value_fact }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $bcFact->created_at->format('d/m/Y H:i') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $bcFact->updated_at->format('d/m/Y H:i') }}</p>
</div>
