<html>
<tr>
    <!-- Horizontal alignment -->
    <td align=""></td>

    <!--  Vertical alignment -->
    <td>Student</td>

    <!-- Rowspan -->
    @foreach($marks as $mark)
        <?php $markOrder[] = $mark->id;?>
        <td>{{ $mark->name }}</td>
    @endforeach
</tr>
{{--<tr><td><?php print_r($data);?></td></tr>--}}
@foreach($data as $student)
    <tr>
        <td>{{ $student['id']}}</td>
        <td>{{ $student['name']}}</td>
        @foreach($markOrder as $id)
            <td>{{ $student[$id] }}</td>
        @endforeach
    </tr>
@endforeach

</html>
