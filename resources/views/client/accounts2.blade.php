@extends('layouts.app')

@section('content')
<x-header header='Accounts'/>

@if (session('message'))
<script>
  Swal.fire({
      toast: true,
      position: 'top-end',
      icon: '{{ session('type') ?? 'success' }}', // optional: 'success', 'error', 'info', etc.
      title: '{{ session('message') }}',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      background: '#333',
      color: '#fff',
      didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
  });
</script>
@endif


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
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAccountModal"><i class="bi bi-pencil-square"></i></button>
                  <button type="button" class="btn btn-warning" onclick="viewAccount({{ $item['id'] }})"><i class="bi bi-eye-fill"></i></button>
                  <button type="button" class="btn btn-danger" onclick="deleteAccount({{ $item['id'] }})"><i class="bi bi-trash"></i></button>
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

<!-- Modal -->
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
<div class="modal fade" id="viewAccountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
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
            <input type="text" class="form-control" name="category" readonly>
          </div>

          <div class="mb-3">
            <label for="account_name" class="form-label">Account Name</label>
            <input type="text" class="form-control" name="account_name" readonly>
          </div>

          <div class="mb-3">
            <label for="account_email" class="form-label">Account Email</label>
            <input type="email" class="form-control" name="account_email" readonly>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="viewPassword" readonly>
          </div>

          <div class="mb-3">
            <input type="checkbox" name="show" id="showPass" class="form-check-input">
            <label for="show" class="form-label ms-1">Show Password</label>
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
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
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" name="category" required>
          </div>

          <div class="mb-3">
            <label for="account_name" class="form-label">Account Name</label>
            <input type="text" class="form-control" name="account_name" required>
          </div>

          <div class="mb-3">
            <label for="account_email" class="form-label">Account Email</label>
            <input type="email" class="form-control" name="account_email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
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


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.getElementById('showPass').addEventListener('change', function () {
    const passwordInput = document.getElementById('viewPassword');
    passwordInput.type = this.checked ? 'text' : 'password';
  });
function viewAccount(id) {
  var showPass = document.getElementById('showPass');
  fetch(`/accounts/${id}`)
    .then(response => response.json())
    .then(data => {
      // Populate modal fields
      data = data.data[0];
      const modal = new bootstrap.Modal(document.getElementById('viewAccountModal'));
      document.querySelector('#viewAccountModal input[name="category"]').value = data.category;
      document.querySelector('#viewAccountModal input[name="account_name"]').value = data.account_name;
      document.querySelector('#viewAccountModal input[name="account_email"]').value = data.account_email;
      document.querySelector('#viewAccountModal input[name="password"]').value = showPass.checked ? data.passwordDecoded : data.password;
      console.log(data.passwordDecoded);
      
      modal.show();
    })
    .catch(error => {
      console.error('Error fetching account data:', error);
      Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: 'Failed to fetch account details.',
      });
    });
}

function deleteAccount(id) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');  
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`/delete-account/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },  
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Swal.fire(
            'Deleted!',
            'Your account has been deleted.',
            'success'
          ).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: data.message || 'Failed to delete account.',
          });
        }
      })
      .catch(error => {
        console.error('Error deleting account:', error);
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Failed to delete account.',
        });
      });
    }
  });
}


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
