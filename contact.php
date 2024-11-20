<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anton&display=swap"
    />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/contact.css" />
  </head>
  <body>
    <div class="main_wrapper">
      <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
          <li>
            <a href="../html/dashboard.html">
              <i class="fas fa-tachometer-alt"></i>
              <span> Dashboard </span>
            </a>
          </li>

          <li class="dropdown">
            <a href="#" onclick="toggleDropdown()">
              <i class="fas fa-utensils"></i>
              <span> Menu </span>
            </a>
            <ul id="dropdown" class="dropdown-content">
              <li>
                <a href="../php/menu.php"><span>Food</span> </a>
              </li>
              <li>
                <a href="../php/minuman.php"><span>Drink</span></a>
              </li>
            </ul>
          </li>

          <li class="active">
            <a href="../php/contact.php">
              <i class="fas fa-phone-alt"></i>
              <span> Contact </span>
            </a>
          </li>
          <li>
            <a href="../php/about.php">
              <i class="fas fa-info-circle"></i>
              <span> About </span>
            </a>
          </li>
          <li class="Logout">
            <a href="../php/logout.php">
              <i class="fas fa-sign-out-alt"></i>
              <span> Logout </span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Container Part -->
      <div class="main_container">
        <div class="header_wrapper">
          <div class="header_title">
            <h2>Contact Us</h2>
          </div>
          <div class="user_info">
            <img src="../image/cilembu (unrevision).png" alt="logo" />
          </div>
        </div>

        <div class="body-container">
        <div class="contact-form">
      <div class="form-section">
        <button>Contact</button>
        <input type="text" placeholder="Name" />
        <input type="email" placeholder="Email" />
        <input type="text" placeholder="Phone Number" />
        <textarea rows="5" placeholder="Message"></textarea>
      </div>
      
      <div class="info-section">
        <h2>Contact <span style="color: #888;">Us</span></h2>
        <p>For questions, technical assistance, or collaboration opportunities via the contact information provided.</p>
        <div class="contact-info">
          <p><i class="fa-solid fa-phone"></i>+62 851-9832-0041</p>
          <p><i class="fas fa-envelope"></i>cilembuhillscafe@gmail.com</p>
          <p><i class="fas fa-map-marker-alt"></i>Jl. Puncak Indah No. 23, Solo</p>
        </div>
      </div>
    </div>
  </div>

        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.querySelector(".sidebar");
        const dropdown = document.querySelector(".dropdown");
        const dropdownContent = document.getElementById("dropdown");

        // Toggle dropdown menu
        dropdown.addEventListener("click", function (e) {
          e.stopPropagation();
          const isDropdownVisible = dropdownContent.style.display === "block";
          dropdownContent.style.display = isDropdownVisible ? "none" : "block";
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (e) {
          if (!sidebar.contains(e.target)) {
            dropdownContent.style.display = "none";
          }
        });
      });
    </script>
  </body>
</html>
