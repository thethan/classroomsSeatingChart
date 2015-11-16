<div class="form-group">
    {!! Form::label('name', 'Mark', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name',$name,['class' => 'control-input form-control', 'placeholder' => 'Mark', 'id' => 'name'], $name) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Save</button>
    </div>
</div>



