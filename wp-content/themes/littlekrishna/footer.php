<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LittleKrishna
 */

?>

<!-- Footer -->
<footer class="bg-dark text-light py-4 text-center">
  <div class="container">
    <p><strong>About Us:</strong> <br> Hindu Baby Names is a cultural platform designed to help parents choose the perfect baby name based on Nakshatra, gender, and tradition. We honor Vedic naming practices with a modern interface for today’s families. Hindu Baby Names is a cultural platform designed to help parents choose the perfect baby name based on Nakshatra, gender, and tradition. We honor Vedic naming practices with a modern interface for today’s families.</p>
   <!-- Social Icons -->
   <p>Follow us:</p>
   <div class="social-icons d-flex justify-content-center gap-3 mb-3">
      <a href="#" class="social-icon facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="social-icon twitter" target="_blank"><i class="fab fa-twitter"></i></a>
      <a href="#" class="social-icon instagram" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="#" class="social-icon pinterest" target="_blank"><i class="fab fa-pinterest-p"></i></a>
    </div>
    <p class="mb-0 small">&copy; 2025 Hindu Baby Name Generator. All rights reserved.</p>
  </div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  document.querySelectorAll(".heart-icon").forEach(function (icon) {
    icon.addEventListener("click", function () {
      // Remove 'liked' class from all icons
      document.querySelectorAll(".heart-icon").forEach(function (el) {
        el.classList.remove("liked");
      });
      // Add 'liked' class only to the clicked icon
      this.classList.add("liked");
    });
  });
</script>

<script>
  console.log("🟢 Inline JS test working");
  </script>

</body>
</html>
