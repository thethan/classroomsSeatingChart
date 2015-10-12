<?php echo Form::token(); ?>
    <div class="form-group">
        {!! Form::label('teachername', 'Teacher Name', array('class' => 'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::text('teachername',$teachername,['class' => 'control-input form-control', 'placeholder' => 'Teacher Name', 'id' => 'teachername'], $teachername) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Grade</label>
        <div class="col-sm-10">
                {!! Form::select('grade',$grades, $grade,array('class' => 'form-control')) !!}


        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>



