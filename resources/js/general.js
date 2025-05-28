
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


async function vp(id) {
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

    if (!isConfirmed) return false;

    try {
        const res = await fetch(`vault/verify/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ password: password, id: id })
        });

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
