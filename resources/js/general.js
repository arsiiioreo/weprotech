
function featureUnavailable() {
    Swal.fire({
        title: "Feature Unavailable",
        text: "This feature is not available yet.",
        icon: "info",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
    });
}

window.featureUnavailable = featureUnavailable;


async function logout() {
  const result = await Swal.fire({
    title: "Are you sure?",
    text: "Are you sure you want to logout?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  });

  if (result.isConfirmed) {
    // Show loading spinner
    Swal.fire({
      title: "Logging out...",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    try {
      await axios.get(`/logout`);

      // Show success after spinner
      Swal.fire("Logged Out!", "You have been successfully logged out.", "success").then(() => {
      });
    } catch (error) {
      Swal.fire("Error", "Something went wrong while logging out.", "error");
      console.error(error);
    }
  }
}


window.logout = logout;


async function vp() {
    const modalElements = document.querySelectorAll('.modal');

    modalElements.forEach(modalEl => {
    const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
    modalInstance.hide();
    });


    const { isConfirmed, value: password } = await Swal.fire({
        title: "Verify Vault Access",
        input: "password",
        inputLabel: "Enter your vault password",
        inputPlaceholder: "••••••••",
        inputAttributes: {
            maxlength: 16,
            autocapitalize: "off",
            autocorrect: "off"
        },
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
    });

    if (!isConfirmed) return null;

    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const res = await fetch(`vault/verify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({ password: password})
        });

        console.log(password);
        

        const data = await res.json();

        if (data['type'] === 'success') {
            await Swal.fire({
                title: "Access Granted",
                text: "You have successfully verified your vault access.",
                icon: "success",
                confirmButtonColor: "#3085d6",
            });
            return true;
        } else {
            await Swal.fire({
                title: "Access Denied",
                text: data['message'],
                icon: "error",
                confirmButtonColor: "#d33",
            });
            return false;
        }

    } catch (error) {
        console.error(error);
        Swal.fire({
            title: "Error",
            text: "Something went wrong during verification.",
            icon: "error",
            confirmButtonColor: "#d33",
        });
        return false;
    }
}

window.vp = vp;


function messageToast(message, type) {
    Swal.fire({
        toast: true,
        position: 'bottom-end',
        icon: type ?? 'success',
        iconColor: 'white',
        title: message,
        showConfirmButton: false,
        customClass: {
            popup: 'colored-toast',
        },
        timer: 3000,
        timerProgressBar: true,
        background: '#333',
        color: '#fff',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
}

window.messageToast = messageToast;

document.addEventListener('DOMContentLoaded', function () {
    const modals = document.querySelectorAll('.modal');

    modals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            modal.querySelectorAll('input, textarea, select').forEach(el => {
                if (el.tagName === 'SELECT') {
                el.selectedIndex = 0;
                } else {
                el.value = '';
                }
            });

            modal.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(el => {
                el.checked = false;
            });   
        });
    });
});