<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        
    </head>
    <body class="antialiased">
        <div id="notification">
            <!-- Chat Messages -->
        </div>

        <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
        <script>
            var pusherAppKey = @json(env('PUSHER_APP_KEY'));
            var pusherAppCluster = @json(env('PUSHER_APP_CLUSTER'));
            var pusher = new Pusher(pusherAppKey, {
                cluster: pusherAppCluster,
            });
            var channel = pusher.subscribe("notifications");
            channel.bind("notification.sent", (data) => {
            // Method to be dispatched on trigger.
                console.log(data);
                let chat = document.getElementById('notification');
                chat.innerHTML += `<div>${data.notification.message}</div>`;
            });
        </script>
    </body>
</html>
