async function viewDiary(id) {
    const verified = await vp();
    
    if (verified === true) {
      // Open the view diary modal
      const viewDiaryModal = new bootstrap.Modal(document.getElementById('viewDiaryModal'));
      viewDiaryModal.show();
    }
}

window.viewDiary = viewDiary;

async function deleteDiary(id) {
  const verified = await vp();

  if (verified === true) {
    const result = await Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    });

    if (result.isConfirmed) {
      alert(id + " is deleted."); 
    }
  } else if (verified === false) {
    Swal.fire({
      icon: "error",
      title: "Incorrect password",
      text: "Access denied. Deletion canceled.",
    });
  } 
}


window.deleteDiary = deleteDiary;