var uploadForm = document.querySelector("#landingPage header form");
var uploadButton = document.querySelector("#landingPage header nav ul li:nth-last-child(2)");

function visibleForm() {
uploadForm.classList.toggle("active");
};

uploadButton.addEventListener("click", visibleForm);