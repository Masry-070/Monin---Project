let editBtn = document.getElementById("editBtn");
let form = document.getElementById("formPopup");
let closeBtn = document.getElementById("closeBtn");

function openForm() {
    form.style.display = "block";
}

function closeForm() {
    form.style.display = "none";
}

editBtn.addEventListener("click", openForm);
closeBtn.addEventListener("click", closeForm);