<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirecting...</title>
</head>
<body>
    <script>
    // Function to redirect after countdown
    function redirect(url) {
        window.location.href = url;
    }

    // Call the countdown function on page load with dynamic URL passed from Laravel
    window.onload = function() {
        const dynamicUrl = "{{ $link }}"; // Accessing the URL passed from Laravel
        redirect(dynamicUrl);
    };
    </script>
</body>
</html>