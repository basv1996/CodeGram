var uploadForm = document.querySelector("body header form");
var uploadButton = document.querySelector("body header nav ul li:nth-last-child(2)");

function visibleForm() {
uploadForm.classList.toggle("active");
};

uploadButton.addEventListener("click", visibleForm);