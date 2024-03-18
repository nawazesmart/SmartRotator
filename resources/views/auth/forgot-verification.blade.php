@extends('auth.layouts.main')

@section('title', 'Forgot Verification')
@section('content')
<div class="card-body mt-2">

    <livewire:auth.forgot-verification :email="$email">
        
    <div class="text-center" id="countdown"></div>
</div>
@endsection
@push('js')
<script src="{{ url('backend/assets/js/jquery-3.7.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Check if countdown value is stored in local storage
        var countdownValue = localStorage.getItem('countdownValue');
        var countStart = localStorage.getItem('countStart');

        if (countdownValue) {
            startCountdown(parseInt(countdownValue, 10));
        } else if(countStart == 1){
            // Start with a default countdown time (e.g., 60 seconds)
            $('#countdown').html("Didn't receive a code ? <a class='text-primary' id='resendBtn' href='{{ route('forgotPasswordSendMail',['id'=>$id]) }}'>Resend</a>");
        }else{
            startCountdown(90);
        }

        $('#resendBtn').on('click', function() {
            // Reset the countdown to the initial value (e.g., 60 seconds)
            startCountdown(90);
        });

        function startCountdown(seconds) {
            var countdown = seconds;
            updateCountdown();

            var countdownInterval = setInterval(function() {
                countdown--;
                updateCountdown();

                if (countdown <= 0) {
                    $('#countdown').html("Didn't receive a code ? <a class='text-primary' id='resendBtn' href='{{ route('forgotPasswordSendMail',['id'=>$id]) }}'>Resend</a>");
                    // Countdown reached zero, clear interval and remove countdown value from local storage
                    clearInterval(countdownInterval);
                    localStorage.removeItem('countdownValue');
                    localStorage.setItem('countStart', 1);
                }
            }, 1000);

            function updateCountdown() {
                var minutes = Math.floor(countdown / 60);
                var seconds = countdown % 60;
                $('#countdown').text('Resend in ' + minutes + ':' + seconds + ' seconds');
                // Store the current countdown value in local storage
                localStorage.setItem('countdownValue', countdown);
            }
        }
    });
</script>
@endpush


