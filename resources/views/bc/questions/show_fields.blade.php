<!-- Bc Result Id Field -->
<div class="col-sm-12">
    {!! Form::label('bc_result_id', 'Bc Result:') !!}
    <p>{{ $bcQuestion->bcResult->name}}</p>
</div>

<!-- Bc Fact Id Field -->
<div class="col-sm-12">
    {!! Form::label('bc_fact_id', 'Bc Fact:') !!}
    <p>{{ $bcQuestion->bcFact->name  }}</p>
</div>

<!-- Question Field -->
<div class="col-sm-12">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $bcQuestion->question }}</p>
</div>

<!-- Code Name Field -->
<div class="col-sm-12">
    {!! Form::label('code_name', 'Code Name:') !!}
    <p>{{ $bcQuestion->code_name }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $bcQuestion->created_at->format('d/m/Y H:i') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $bcQuestion->updated_at->format('d/m/Y H:i') }}</p>
</div>


