@extends('layouts.app')

@section('content')
<x-header header='Diary'/>
<div class="d-flex justify-content-between align-items-center">
    <form action="" class="w-25 me-2">
        <div class="d-flex align-items-center gap-2">
            @php
                $sortSelect = [
                    'def' => ['name' => 'Sort By', 'value' => '', 'selected' => 'selected', 'disabled' => 'disabled'],
                    'title' => ['name' => 'Title', 'value' => 'title', 'selected' => '', 'disabled' => ''],
                    'date' => ['name' => 'Date', 'value' => 'date', 'selected' => '', 'disabled' => ''],
                ];
                $orderSelect = [
                    'def' => ['name' => 'Order By', 'value' => '', 'selected' => 'selected', 'disabled' => 'disabled'],
                    'desc' => ['name' => 'Descending', 'value' => 'desc', 'selected' => '', 'disabled' => ''],
                    'asc' => ['name' => 'Ascending', 'value' => 'asc', 'selected' => '', 'disabled' => ''],
                ];
            @endphp

            <select name="sort" id="sort" class="form-select border border-2" style="border-color: #191919 !important;">
                @foreach ($sortSelect as $item)
                    <option value="{{$item['value']}}" {{$item['selected']}} {{$item['disabled']}}> {{$item['name']}} </option>
                @endforeach
            </select>
            <select name="order" id="order" class="form-select border border-2" style="border-color: #191919 !important;">">
                @foreach ($orderSelect as $item)
                    <option value="{{$item['value']}}" {{$item['selected']}} {{$item['disabled']}}>{{$item['name']}}</option>
                @endforeach
            </select>
            <button type="button" class="btn" style="background-color: #191919"><i class="bi bi-funnel-fill text-white fw-bold"></i></button>
        </div>
    </form>
    <button type="button" class="btn text-white py-2 px-4" style="background-color: #191919" data-bs-toggle="modal" data-bs-target="#diaryModal">
        <i class="bi bi-plus-circle fw-bold me-2"></i>
        <span>Add New</span>
    </button>
</div>
<div class="position-relative overflow-auto mt-2" style="height: 100%;">
    <table class="table table-striped table-hover text-center">
        @php
            $table = [
                'header' => [
                    'No.',
                    'Title',
                    'Message',
                    'Date Created',
                    'Last Modified',
                    'Actions'
                ],
                
                'data' => [
                    [
                        '1',
                        'title' => 'My First Diary Entry',
                        'message' => 'This is my first diary entry. I am excited to start this journey.',
                        'date_created' => '2023-10-01',
                        'last_modified' => '2023-10-02',
                    ],
                    [
                        '2',
                        'title' => 'A Day in the Life',
                        'message' => 'Today was a great day! I went for a walk and enjoyed the sunshine.Today was a great day! I went for a walk and enjoyed the sunshine.',
                        'date_created' => '2023-10-03',
                        'last_modified' => '2023-10-04',
                    ],
                ]
              ];
            $i = 0;

        @endphp
        <thead class="position-sticky top-0 table-dark">
            <tr>
                @foreach ($table['header'] as $head)
                <th style="background-color: #191919 !important;" scope="col">{{ $head }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($table['data'] as $item)
            <tr>
                @foreach ($item as $col)
                    <td class="text-truncate" style="max-width: 0px;">{{ $col }}</td>
                @endforeach
                <td class="d-flex justify-content-center gap-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDiaryModal"><i class="bi bi-pencil-square"></i></button>
                    <button type="button" class="btn btn-warning" onclick="viewDiary('1')"><i class="bi bi-eye-fill"></i></button>
                    <button type="button" class="btn btn-danger" onclick="deleteDiary('1')"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="diaryModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-pencil-fill fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">Dear Diary</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form>
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="message" rows="10"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Keep this!</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewDiaryModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-person-square fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">View Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form>
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
          </div>

          <div class="mb-3">
            <label for="account_name" class="form-label">Account Name</label>
            <input type="text" class="form-control" id="account_name" name="account_name" required>
          </div>

          <div class="mb-3">
            <label for="account_email" class="form-label">Account Email</label>
            <input type="email" class="form-control" id="account_email" name="account_email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editDiaryModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-person-fill-gear fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">Edit Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form>
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="message" rows="10"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Vault Password Modal -->
<div class="modal fade" id="vaultPassword" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-lock-fill fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">Verify Vault Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="confirmPasswordForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#viewDiaryModal">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- <script src="{{Vite::asset('/resources/js/diary.js')}}"></script> --}}
@endsection
