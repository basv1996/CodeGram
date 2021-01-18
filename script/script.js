var uploadForm = document.querySelector("#landingPage header form");
var uploadButton = document.querySelector("#landingPage header nav ul li:nth-of-type(2) a");

function visibleForm() {
uploadForm.classList.toggle("active");
};

uploadButton.addEventListener("click", visibleForm);