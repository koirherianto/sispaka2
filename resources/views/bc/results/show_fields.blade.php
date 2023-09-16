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
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $bcResult->updated_at->format('d/m/Y H:i') }}</p>
</div>

