<html lang="en">

<head>
    <meta charset="utf-8">
</head>

</html>

<body>
    <script>
        window.onload = function() {
            @if($user)
            var user = '{!! $user !!}';
            var token = '{{ $access_token }}';
            parent.postMessage({
                connectStatus: "connected",
                user: "" + user + "",
                accessToken: "" + token + ""
            }, "*");
            @else
            parent.postMessage({
                connectStatus: "needs-auth"
            }, "*");
            @endif
        };
    </script>
</body>
