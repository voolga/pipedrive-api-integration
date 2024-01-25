const submitForm = document.querySelector(".task-form");
const spinnerEl = document.querySelector(".spinner");
const submitBtnEl = document.querySelector(".submit-button");

submitForm.addEventListener("submit", function (event) {
  event.preventDefault();

  spinnerEl.classList.remove("spinner_hidden");

  const formData = new FormData(this);

  fetch("rest.php", {
    method: "POST",
    body: formData,
  })
    .then(() => {
      event.target.reset();
      spinnerEl.classList.remove("spinner_hidden");
      submitBtnEl.innerHTML = "Data was sent";
    })
    .catch((error) => {
      console.error("Ошибка при отправке формы:", error);
    });
});
