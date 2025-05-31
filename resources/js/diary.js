async function viewDiary(id) {
  const verified = await vp();
  if (verified)
  {
    const viewDiaryModal = new bootstrap.Modal(document.getElementById('viewDiary'));
    const card = document.getElementById(`diary-${id}`);
  
    // Extract from data-*
    const title = card.dataset.title;
    const message = card.dataset.message;
    const date = card.dataset.date;
  
    // Populate modal
    document.getElementById('accountDiaryTitle').innerText = title;
    document.getElementById('accountDiaryMessage').innerText = message;
    document.getElementById('accountDiaryDate').innerText = date;
  
    document.getElementById('diaryDelete').onclick = () => deleteDiary(id);
    viewDiaryModal.show();  
  }
}

window.viewDiary = viewDiary;

async function deleteDiary(id) {
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
    try {
      location.replace(`/delete-diary/${id}`);
    } catch (error) {
      Swal.fire("Error", "Something went wrong while deleting.", "error");
      console.error(error);
    }
  }
}


window.deleteDiary = deleteDiary;