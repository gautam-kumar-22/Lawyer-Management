<!DOCTYPE html>
<html>
<head>
    <title>{{ $name }}</title>
</head>
<body>
    <h1>{{ App('general_setting')->mail_header }}</h1>
    <h4>{{ $subject }}</h4>
    <p>{!! $content !!}</p>

    <p>Thank you</p>
</body>
</html>
