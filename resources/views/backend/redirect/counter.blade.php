<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Page Counter</title>
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
  }
  #counter {
    font-size: 24px;
    margin-top: 50px;
  }
</style>
</head>
<body>
<div id="counter">Redirecting in <span id="countdown">10</span> seconds...</div>

<script>
  // Function to redirect after countdown
  function redirect(url) {
    window.location.href = url;
  }

  // Function to update countdown and redirect after 10 seconds
  function startCountdown(url) {
    let seconds = 10;
    const countdownElement = document.getElementById('countdown');
    const countdownInterval = setInterval(() => {
      seconds--;
      countdownElement.textContent = seconds;
      if (seconds <= 0) {
        clearInterval(countdownInterval);
        redirect(url);
      }
    }, 1000);
  }

  // Call the countdown function on page load with dynamic URL passed from Laravel
  window.onload = function() {
    const dynamicUrl = "{{ $link }}"; // Accessing the URL passed from Laravel
    startCountdown(dynamicUrl);
  };
</script>
</body>
</html>
