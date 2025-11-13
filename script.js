import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
import {
  getDatabase,
  ref,
  push,
} from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-analytics.js";

// Firebase config
const firebaseConfig = {
  apiKey: "AIzaSyDMC2-cMIGS9wpDKlAWIJ0wArRlKYDqvzs",
  authDomain: "freeclasswaheemtech.firebaseapp.com",
  databaseURL: "https://freeclasswaheemtech.firebaseio.com",
  projectId: "freeclasswaheemtech",
  storageBucket: "freeclasswaheemtech.firebasestorage.app",
  messagingSenderId: "520516252714",
  appId: "1:520516252714:web:124d1060d13cdf6a4abf53",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
const analytics = getAnalytics(app);

// Mobile menu toggle
const mobileMenu = document.querySelector(".mobile-menu");
const nav = document.querySelector("nav");

mobileMenu.addEventListener("click", () => {
  nav.classList.toggle("active");
});

// Smooth scrolling for navigation links
document.querySelectorAll("nav a").forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const targetId = this.getAttribute("href");
    const targetSection = document.querySelector(targetId);

    window.scrollTo({
      top: targetSection.offsetTop - 80,
      behavior: "smooth",
    });

    // Close mobile menu if open
    nav.classList.remove("active");
  });
});

// Scroll to register function
function scrollToRegister() {
  const registerSection = document.getElementById("register");
  window.scrollTo({
    top: registerSection.offsetTop - 80,
    behavior: "smooth",
  });
}

// Handle application form submission
const audienceForm = document.getElementById("audienceForm");
const successMessage = document.getElementById("successMessage");

audienceForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  // Get form values
  const formData = {
    fullName: document.getElementById("fullName").value,
    email: document.getElementById("email").value,
    phone: document.getElementById("phone").value,
    referral: document.getElementById("referral").value,
    location: document.getElementById("location").value,
    dob: document.getElementById("dob").value,
    course: document.getElementById("course").value,
    youtubeProof:
      document.getElementById("youtubeProof").files[0]?.name || "Not uploaded",
    telegramProof:
      document.getElementById("telegramProof").files[0]?.name || "Not uploaded",
    timestamp: new Date().toISOString(),
  };

  try {
    // Save to Firebase
    await push(ref(db, "applications/"), formData);

    // Show success message
    successMessage.style.display = "block";

    // Reset form
    audienceForm.reset();

    // Hide success message after 5 seconds
    setTimeout(() => {
      successMessage.style.display = "none";
    }, 5000);
  } catch (error) {
    console.error("Error saving application:", error);
    alert("There was an error submitting your application. Please try again.");
  }
});

// Handle contact form submission
const contactForm = document.getElementById("contactForm");

contactForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  const contactData = {
    name: document.getElementById("contactName").value,
    email: document.getElementById("contactEmail").value,
    subject: document.getElementById("contactSubject").value,
    message: document.getElementById("contactMessage").value,
    timestamp: new Date().toISOString(),
  };

  try {
    // Save to Firebase
    await push(ref(db, "contacts/"), contactData);

    alert("Thank you for your feedback! We will get back to you soon.");

    // Reset form
    contactForm.reset();
  } catch (error) {
    console.error("Error saving contact:", error);
    alert("There was an error sending your message. Please try again.");
  }
});
