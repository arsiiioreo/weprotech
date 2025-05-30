
@php
  use Jenssegers\Agent\Agent;
  $agent = new Agent();
@endphp
@if ($agent->isMobile())
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100 pb-3 border-bottom border-1 mb-4 gap-2 gap-md-0">  
  <div class="d-flex flex-sm-row align-items-center align-items-sm-center ps-2 ps-md-0">
    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=191919&color=fff&size=64" class="" style="width: 3rem; border-radius: 50%; border: 2px solid #191919;">
    <h2 class="fs-5 m-0 ps-2" style="font-weight: 800;">
      {{ $header }}
    </h2>
  </div>
  <p class="m-0 me-sm-3 mb-1 mb-sm-0 small small-md">
    Today: <span class="fw-bold" id="current-time"></span>
  </p>
</div>
@else
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100 pb-3 border-bottom border-1 mb-4 gap-2 gap-md-0">
  <h2 class="fs-3 fs-md-3 m-0 ps-2" style="font-weight: 800;">
    {{ $header }}
  </h2>

  <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center ps-2 ps-md-0">
    <p class="m-0 me-sm-3 mb-1 mb-sm-0 small small-md">
      Today: <span class="fw-bold" id="current-time"></span>
    </p>

    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=191919&color=fff&size=64"
      style="width: 35px; border-radius: 50%; border: 2px solid #191919;">
  </div>
</div>
@endif



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
