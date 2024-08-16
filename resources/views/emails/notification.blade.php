<!-- resources/views/emails/notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
</head>
<body>
    <h1>{{ $notification->type }}</h1>
    <p>{{ $notification->message }}</p>
</body>
</html>
