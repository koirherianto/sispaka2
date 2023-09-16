<!-- Bc Result Id Field -->
<div class="col-sm-12">
    {!! Form::label('bc_result_id', 'Bc Result Id:') !!}
    <p>{{ $bcQuestion->bc_result_id }}</p>
</div>

<!-- Bc Fact Id Field -->
<div class="col-sm-12">
    {!! Form::label('bc_fact_id', 'Bc Fact Id:') !!}
    <p>{{ $bcQuestion->bc_fact_id }}</p>
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

