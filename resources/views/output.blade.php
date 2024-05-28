<!DOCTYPE html>
<html>
<head>
    <title>Python Script Output</title>
</head>
<body>
    <h1>Output of Python Script:</h1>
    <ul>
        @foreach($output as $line)
            <li>{{ $line }}</li>
        @endforeach
    </ul>
</body>
</html>