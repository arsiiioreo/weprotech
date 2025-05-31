let pass =''
let passDecoded =''

async function viewAccounts(id) {
    const verified = await vp();
    
  if (verified) {
    const viewAccount = new bootstrap.Modal(document.getElementById('viewAccountModal'));
    const card = document.getElementById(`account-${id}`);
  
    // Extract from data-*
    const category = card.dataset.category;
    const account_name = card.dataset.account_name;
    const account_email = card.dataset.account_email;
    const password = card.dataset.password;
  
    // Populate modal
    document.getElementById('viewCategory').value = category;
    document.getElementById('viewAccName').value = account_name;
    document.getElementById('viewAccEmail').value = account_email;
    document.getElementById('viewPassword').value = password;

    pass = card.dataset.password;
    passDecoded = card.dataset.password_decoded;
  
    viewAccount.show();  
  }
}

var showPass = document.getElementById('showPass')
showPass?.addEventListener('change', function () {
const passField = document.getElementById('viewPassword');
  passField.type = this.checked ? 'text' : 'password';
  passField.value = this.checked ? passDecoded : pass;
});

window.viewAccounts = viewAccounts;

async function deleteAccount(id) {
  var verified = await vp();

  if (verified) {
    const result = await Swal.fire({
      title: "Are you sure?",
      text: "This action cannot be undone.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Yes, delete it!",
      reverseButtons: true
    });

    if (result.isConfirmed) {
      try {
        location.replace(`/delete-account/${id}`);
      } catch (error) {
        Swal.fire("Error", "Something went wrong while deleting.", "error");
        console.error(error);
      }
    }
  }
}


window.deleteAccount = deleteAccount;