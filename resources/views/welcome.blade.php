<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <table class="table table-striped">
                <thead class="text-center">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Option</th> 
                        <th>FullName</th>
                        <th>Student Code</th>
                        <th>Total Number Of Unit</th>
                        <th>average</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($students as $student)
                        <tr class="text-center">
                            <td>#</td>
                            <td>
                                <i onclick="myNested()" class="fas fa-user text-success"></i>
                                <div class="nested" style="display: none;">
                                    <table>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </table>
                                </div>
                            </td>
                            <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                            <td>{{ $student->student_code }}</td>
                        @if($student->total_unit != null)
                            <td>{{ $student->total_unit }}</td>
                            @else
                            <td>not have</td>
                        @endif
                        @if($student->total_unit != null)
                            <td>{{ $student->total_unit }}</td>
                            @else
                            <td>not have</td>
                        @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>

<script>
function myNested() {
  
  document.getElementById("nested").style.display = "none";

}
</script>