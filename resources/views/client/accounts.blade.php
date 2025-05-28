@extends('layouts.app')

@section('content')
<x-header header='Accounts'/>


<div class="position-relative overflow-auto" style="height: 100%;">
    <button id="addAccountBtn" type="button" class="btn px-3 text-center text-white"
      style="min-width: 10rem;background-color: #191919;">
      <i class="bi bi-plus-circle me-2"></i>
      <span>ADD NEW</span>
    </button>

    <table id="accounts-table" class="table table-striped table-hover text-center">
        <thead class="position-sticky top-0 table-dark">
            <tr>
                <th class="text-center" style="background-color: #191919 !important;" scope="col">Category</th>
                <th class="text-center" style="background-color: #191919 !important;" scope="col">Account Name</th>
                <th class="text-center" style="background-color: #191919 !important;" scope="col">Account Email</th>
                <th class="text-center" style="background-color: #191919 !important;" scope="col">Date Created</th>
                <th class="text-center" style="background-color: #191919 !important;" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($accounts as $item)
            <tr>
              <td>{{$item['category']}}</td>
              <td>{{$item['account_name']}}</td>
              <td>{{$item['account_email']}}</td>
              <td>{{$item['created_at_human']}}</td>
              <td class="d-flex justify-content-center gap-1">
                  <a type="button" class="btn btn-primary" href="{{ route('openEditAccountModal', $item['id'])}}"><i class="bi bi-pencil-square"></i></a>
                  <a type="button" class="btn btn-warning" href="{{ route('getSecretAccount', $item['id'])}}" ><i class="bi bi-eye-fill"></i></a>
                  <button type="submit" class="btn btn-danger delete-confirm-btn">
                      <i class="bi bi-trash"></i>
                  </button>
                  <form id="deleteAccount" action="{{ route('deleteSecretAccount', $item['id']) }}" method="POST" class="d-none">
                    @csrf
                  </form>
                  @push('scripts')
                      <script>
                        document.querySelector('.delete-confirm-btn').addEventListener('click', function (e) {
                          Swal.fire({
                              title: "Are you sure?",
                              text: "This action cannot be undone.",
                              icon: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#d33",
                              cancelButtonColor: "#6c757d",
                              confirmButtonText: "Yes, delete it!",
                              reverseButtons: true
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  document.getElementById('deleteAccount').submit();
                              }
                          });
                        });
                      </script>
                  @endpush
              </td>
            </tr>
            @endforeach
            {{-- <tr>
              <td colspan="5" style="background-color: #191919 !important; color: white;">End of the list.</td>
            </tr> --}}
        </tbody>
    </table>
</div>


@if (session('accountModal'))
@push('scripts')
<script>
  window.addEventListener('load', () => {
    const accountModal = new bootstrap.Modal(document.getElementById('accountModal'));
    accountModal.show();
  });
  </script>

@endpush
@endif

<!-- Add Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-person-fill-add fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">Create New Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form method="POST" action="{{ route('createSecretAccount') }}">
        @csrf
        <div class="modal-body">
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="category" :value="__('Category')" />
              <x-text-input id="category" type="text" name="category" placeholder="Enter Category (e.g. Faceboook, Instagram, etc.)" required autocomplete="current-category"/>
              <x-input-error :messages="$errors->get('category')" class="invalid-feedback" />
          </div>
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="account_name" :value="__('Account Name')" />
              <x-text-input id="account_name" type="text" name="account_name" placeholder="Enter Account Name" required autocomplete="name"/>
              <x-input-error :messages="$errors->get('account_name')" class="invalid-feedback" />
          </div>
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="account_email" :value="__('Account Email')" />
              <x-text-input id="account_email" type="email" name="account_email" placeholder="Enter Account Email" required autocomplete="email"/>
              <x-input-error :messages="$errors->get('account_email')" class="invalid-feedback" />
          </div>
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="password" :value="__('Password')" />
              <x-text-input id="password" type="password" name="password" placeholder="Enter Password" required/>
              <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
          </div>
          
          <div class="d-flex flex-column mb-2">
              <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
              <x-text-input id="password_confirmation" type="password" name="password_confirmation" placeholder="Enter Password" required/>
              <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback" />
          </div>
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary"><span><i class="bi bi-save me-2"></i></span>Save Account</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!-- View Modal -->
@if (session('showAccountModal'))
<script>
    window.addEventListener('load', () => {
        const modal = new bootstrap.Modal(document.getElementById('viewAccountModal'));
        modal.show();
    });
</script>
@endif

<div class="modal fade" id="viewAccountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-person-square fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">View Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <input type="text" class="form-control" name="category"  value="{{ session('secretAccount.category') }}">
        </div>

        <div class="mb-3">
          <label for="account_name" class="form-label">Account Name</label>
          <input type="text" class="form-control" name="account_name" readonly value="{{ session('secretAccount.account_name') }}">
        </div>

        <div class="mb-3">
          <label for="account_email" class="form-label">Account Email</label>
          <input type="email" class="form-control" name="account_email" readonly value="{{ session('secretAccount.account_email') }}">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="viewPassword" readonly value="{{ session('secretAccount.password') }}">
        </div>

        <div class="mb-3">
          <input type="checkbox" name="show" id="showPass" class="form-check-input">
          <label for="show" class="form-label ms-1">Show Password</label>
        </div>
      </div>      

    </div>
  </div>
</div>

<!-- Edit Modal -->
@if (session('showAccountModalEdit'))
<script>
    window.addEventListener('load', () => {
        const modal = new bootstrap.Modal(document.getElementById('editAccountModal'));
        modal.show();
    });
</script>
@endif

<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header py-2">
        <span><i class="bi bi-person-fill-gear fs-4"></i></span>
        <h5 class="modal-title ms-3" id="accountModalLabel">Edit Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="{{ route('updateSecretAccount') }}" method="POST">
          @csrf
          <input type="hidden" class="form-control" name="id" required value="{{ session('dataEdit.id') }}">
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            @isset(session('dataEdit')['category'])
            <input type="text" class="form-control" name="category" required value="{{ session('dataEdit')['category'] }}">
            @endisset
          </div>

          <div class="mb-3">
            <label for="account_name" class="form-label">Account Name</label>
            @isset(session('dataEdit')['category'])
            <input type="text" class="form-control" name="account_name" required value="{{ session('dataEdit')['account_name'] }}">
            @endisset
          </div>

          <div class="mb-3">
            <label for="account_email" class="form-label">Account Email</label>
            @isset(session('dataEdit')['category'])
            <input type="text" class="form-control" name="account_email" required value="{{ session('dataEdit')['account_email'] }}">
            @endisset
          </div>

          <div class="mb-3">
            <label for="old_password" class="form-label">Old Password</label>
            <input type="password" class="form-control" name="old_password" required>
          </div>

          <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_password">
          </div>

          <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="new_password_confirmation">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.getElementById('showPass')?.addEventListener('change', function () {
    
    const passField = document.getElementById('viewPassword');
    passField.type = this.checked ? 'text' : 'password';
    passField.value = this.checked ? '{{session('secretAccount.passwordDecoded')}}' : '{{session('secretAccount.password')}}';
  
});


$(document).ready(function () {
  const table = $('#accounts-table').DataTable({
    paging: false,
  });

  const filterWrapper = $('#accounts-table_filter');

  filterWrapper.addClass('d-flex align-items-center gap-1 mb-3');

  setTimeout(() => {
    const searchInput = filterWrapper.find('label');
    searchInput.wrap('<div class="me-1"></div>');
    filterWrapper.append($('#addAccountBtn'));
  }, 0);

  $('#addAccountBtn')
    .attr({
      'data-bs-toggle': 'modal',
      'data-bs-target': '#accountModal',
    })
    .addClass('btn px-3 text-white')
    .css({
      'min-width': '10rem',
      'background-color': '#191919',
    });
});

</script>    
@endpush

<style>
  td:nth-child(1),
  td:nth-child(2){
    text-transform: capitalize
  }
</style>
@endsection


