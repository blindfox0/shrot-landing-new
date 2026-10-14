// Silnik generujący odpowiedni komunikat i styl powiadomienia w zależności od danych pochodzących z PHP
let messageContent = document.querySelector(".message-content");

const messageStyle = {
  success: ["bg-green-400", "p-2", "text-white", "mb-2"],
  warning: ["bg-yellow-400", "p-2", "text-white", "mb-2"],
  error: ["bg-red-600", "p-2", "text-white", "mb-2"],
};

if (flashMessage.type == "success") {
  messageContent.classList.add(...messageStyle.success);
  messageContent.innerHTML = flashMessage.text;
} else if (flashMessage.type == "warning") {
  messageContent.classList.add(...messageStyle.warning);
  messageContent.innerHTML = flashMessage.text;
} else {
  messageContent.classList.add(...messageStyle.error);
  messageContent.innerHTML = flashMessage.text;
}

const turnOffMessage = setTimeout(function () {
  messageContent.style.display = "none";
}, 4000);
