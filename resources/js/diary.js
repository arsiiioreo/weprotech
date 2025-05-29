async function viewDiary(id) {
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

window.viewDiary = viewDiary;

async function deleteDiary(id) {
  // const verified = await vp();
  const result = await Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  });

  if (result) {
    alert('deleted');
  } 
}


window.deleteDiary = deleteDiary;