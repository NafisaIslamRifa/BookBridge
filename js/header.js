document.addEventListener("DOMContentLoaded", function () {
   var userBtn = document.getElementById('user-btn');
   var userBox = document.querySelector('.right-section .user-box');

   userBtn.addEventListener('click', function () {
       userBox.classList.toggle('active');
   });
});
