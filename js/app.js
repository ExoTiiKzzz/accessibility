//check if there is a message in session storage
if (sessionStorage.getItem('message')) {
  Toastify({
    text: sessionStorage.getItem('message'),
    duration: 3000,
    close: true,
    style: {
      background: "linear-gradient(to right, #00b09b, #96c93d)",
    }
  }).showToast();

  // remove the message from session storage
  sessionStorage.removeItem('message');
}
