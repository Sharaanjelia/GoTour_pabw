// Hero Slider
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
  slides.forEach(slide => slide.classList.remove('active'));
  dots.forEach(dot => dot.classList.remove('active'));

  slides[index].classList.add('active');
  dots[index].classList.add('active');
}

window.changeSlide = function(direction) {
  currentSlideIndex += direction;
  if (currentSlideIndex < 0) currentSlideIndex = slides.length - 1;
  if (currentSlideIndex >= slides.length) currentSlideIndex = 0;
  showSlide(currentSlideIndex);
}

window.currentSlide = function(index) {
  currentSlideIndex = index;
  showSlide(currentSlideIndex);
}

// Auto slide every 7 seconds
setInterval(() => {
  changeSlide(1);
}, 7000);

// Mobile menu
const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');

if (menuToggle) {
  menuToggle.addEventListener('click', () => {
    if (navLinks.style.display === "flex") {
      navLinks.style.display = "none";
    } else {
      navLinks.style.display = "flex";
      navLinks.style.flexDirection = "column";
      navLinks.style.position = "absolute";
      navLinks.style.top = "100%";
      navLinks.style.left = "0";
      navLinks.style.right = "0";
      navLinks.style.background = "linear-gradient(135deg, #059669 0%, #047857 100%)";
      navLinks.style.padding = "2rem";
      navLinks.style.gap = "1.5rem";
    }
  });
}

// Scroll animation
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) entry.target.classList.add('active');
  });
}, { threshold:0.1, rootMargin:'0px 0px -100px 0px' });

document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
