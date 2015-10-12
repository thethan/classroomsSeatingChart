<?php echo Form::token(); ?>
    <div class="form-group">
        {!! Form::label('color', 'number', array('class' => 'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::text('number',$number,['class' => 'control-input form-control', 'placeholder' => 'number', 'id' => 'number'], $number) !!}
        </div>
    </div>
    <div class="form-group">

    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>



