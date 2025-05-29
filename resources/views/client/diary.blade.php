@extends('layouts.app')

@section('content')
<x-header header='Diary'/>

{{-- Add New Diary Button --}}
<a href="javascript:void(0)" class="btn position-absolute bottom-0 m-5 text-white p-2" style="right: 0; background-color: #191919;" data-bs-toggle="modal" data-bs-target="#addDiary">
  <i class="bi bi-plus-lg fs-4 p-2"></i>
</a>

<div class="container py-4 overflow-auto">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    {{-- Sample Diary Cards (Loop through actual diary entries here) --}}
    @if (count($diaries) > 0)
      @foreach ($diaries as $diary)
      <a href="javascript:void(0)" onclick="viewDiary({{ $diary->id }})" style="text-decoration: none;"
        data-title="{{ $diary->title }}"
        data-message="{{ $diary->messageDecrypted }}"
        data-date="{{ \Carbon\Carbon::parse($diary->created_at)->format('F d, Y - h:i A') }}"
        id="diary-{{ $diary->id }}">
        <div class="col">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title fw-semibold">Title: {{ $diary->title }}</h5>
              <hr>
              <p class="card-text text-muted small mb-1">{{ $diary->created_at_human }}</p>
              {{-- <p class="card-text text-muted small mb-1">10:00</p> --}}
              <p class="card-text mt-3 mb-0">Message is encrypted. Click to view.</p>
              <p class="text-end m-0"><i class="bi bi-chevron-right"></i></p>
              {{-- <p class="card-text">Eto text</p> --}}
            </div>
          </div>
        </div>
      </a>
      @endforeach
    @else
        <div class="d-flex justify-content-center align-items-center text-center w-100 pt-5">No secrets yet, write one now.</div>
    @endif
  </div>
</div>

@if (session('addDiary'))
    <script>
      const addDiary = new bootstrap.Modal(document.getElementById('addDiary'));
      addDiary.show();
    </script>
@endif

{{-- Add Diary Modal --}}
<div class="modal fade" id="addDiary" tabindex="-1" aria-labelledby="accountDiaryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-person-fill-add fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountDiaryLabel">Add New Secret</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form method="POST" action="{{ route('add-diary')}}">
        @csrf
        <div class="modal-body">
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="title" :value="__('Title')" />
              <x-text-input id="title" type="text" name="title" placeholder="Enter Title" required/>
              <x-input-error :messages="$errors->get('title')" class="invalid-feedback" />
          </div>
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="message" :value="__('Message')" />
              <textarea id="message" class="form-control" type="text" name="message" placeholder="What's the tea darling? Spill the tea..." required rows="10" style="resize: none"></textarea>
              <x-input-error :messages="$errors->get('message')" class="invalid-feedback" />
          </div>
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary"><span><i class="bi bi-save me-2"></i></span>Save Secret</button>
        </div>
      </form>
      
    </div>
  </div>
</div>


{{-- View Diary Modal --}}
<div class="modal fade" id="viewDiary" tabindex="-1" aria-labelledby="accountDiaryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="text-end p-3 pb-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body p-4 pt-0" id="diaryBody">
        <h5 class="fw-bold mb-4 text-center" id="accountDiaryTitle"></h5>
        
        <hr class="hr">

        <div class="d-flex justify-content-between align-items-center w-100 mb-4">
          <p class="fw-semibold fs-6 text-start m-0">Dear Diary,</p>
          <p class="text-muted small mb-0" id="accountDiaryDate">Sample Date</p>
        </div>


        <div class="">
          <div>
            <span id="accountDiaryMessage"></span>
          </div>
        </div>
        
        <div class="text-end mt-4 p-2">
          <button type="button" class="btn btn-danger" id="diaryDelete">Delete</button>
        </div>
      </div>

      
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  
</script>
@endpush
