document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("orderModal");
  const modalImage = modal.querySelector(".modal-content img");
  const orderNowBtns = document.querySelectorAll(".order-now-btn");

  orderNowBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
          // Get the image source from the button's parent or data attribute
          const imgSrc = btn.closest('figure').querySelector('img').src;
          modalImage.src = imgSrc;  // Change modal image
          modal.style.display = "block";  // Show the modal
      });
  });

  // Close the modal
  const closeBtn = modal.querySelector(".close-btn");
  closeBtn.addEventListener("click", function () {
      modal.style.display = "none";
  });

  // Close the modal if clicked outside
  window.addEventListener("click", function (event) {
      if (event.target === modal) {
          modal.style.display = "none";
      }
  });
});
