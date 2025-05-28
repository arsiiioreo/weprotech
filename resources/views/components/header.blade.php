<div class="d-flex justify-content-between align-items-center w-100 pb-4">
    <h2 class="text-center fs-3 m-0 ps-2" style="font-weight: 800">{{$header}}</h2>
    <div class="d-flex align-items-center">
        <p class="m-0 me-2">Today: <span class="fw-bold" id="current-time"></span></p>
        <img class="avatar" src="{{ asset('images/dark_logo.png') }}" alt="" style="width: 35px; border-radius: 50%; border: 2px solid #191919;">
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const options = {
            year: 'numeric', month: 'long', day: '2-digit',
            hour: '2-digit', minute: '2-digit', second: '2-digit',
            hour12: true
        };
        const formattedTime = now.toLocaleString('en-US', options);
        document.getElementById('current-time').innerText = formattedTime;
    }

    setInterval(updateClock, 1000);

    updateClock();
</script>
