import './bootstrap';
import 'bootstrap';
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';

// import Alpine from 'alpinejs';

window.bootstrap = bootstrap;
window.Swal = Swal;

// document.addEventListener('DOMContentLoaded', () => {
//     const form = document.getElementById("createSecretAccount");
//     form.addEventListener("submit", async function (e) {
//         e.preventDefault();
//     });
// });


function messageToast(title, icon) {
    Swal.fire({
        toast: true,
        position: 'bottom-end',
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast',
        },
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
}