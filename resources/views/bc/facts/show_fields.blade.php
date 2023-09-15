<!-- Backward Chaining Id Field -->
<div class="col-sm-12">
    {!! Form::label('backward_chaining_id', 'Backward Chaining Id:') !!}
    <p>{{ $bcFact->backward_chaining_id }}</p>
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

<!-- Value Fact Field -->
<div class="col-sm-12">
    {!! Form::label('value_fact', 'Value Fact:') !!}
    <p>{{ $bcFact->value_fact }}</p>
</div>

