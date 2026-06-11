    <!-- ===================== FOOTER ===================== -->
    <footer class="fr-footer">
      <div class="fr-container">
        <div class="fr-footer-grid">
          <div>
            <div class="fr-foot-brand">
              <img src="assets/img/station.png" alt="Fire Rescue" />
              <span>Fire Rescue</span>
            </div>
            <p>
              A web-based emergency response system that lets citizens report fires with a live
              photo and GPS location, routed instantly to the nearest Rescue Control Center.
            </p>
            <div class="fr-socials">
              <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
              <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
          </div>

          <div>
            <h4>Quick Links</h4>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="complaint.php">Urgent Complaint</a></li>
              <li><a href="posts.php">Safety Posts</a></li>
              <li><a href="login.php">Login</a></li>
            </ul>
          </div>

          <div>
            <h4>Resources</h4>
            <ul>
              <li><a href="posts.php">Fire Safety Tips</a></li>
              <li><a href="complaint.php">Report a Fire</a></li>
              <li><a href="#">Prevention Guide</a></li>
              <li><a href="#">About Us</a></li>
            </ul>
          </div>

          <div>
            <h4>Contact</h4>
            <ul class="fr-foot-contact">
              <li><i class="fa-solid fa-phone"></i> Emergency Hotline: 16 / 1122</li>
              <li><i class="fa-solid fa-location-dot"></i> Rescue Control Center, Lahore</li>
              <li><i class="fa-solid fa-envelope"></i> support@firerescue.local</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="fr-footer-bottom">
        &copy; <span id="frYear">2026</span> Fire Rescue Response System. All rights reserved.
      </div>
    </footer>

    <script>
      // --- Sticky header shadow on scroll ---
      var frHeader = document.getElementById('frHeader');
      window.addEventListener('scroll', function () {
        if (frHeader) frHeader.classList.toggle('fr-scrolled', window.scrollY > 20);
      });

      // --- Mobile menu toggle ---
      var frBurger = document.getElementById('frBurger');
      var frMenu = document.getElementById('frMobileMenu');
      if (frBurger && frMenu) {
        frBurger.addEventListener('click', function () {
          frBurger.classList.toggle('fr-open');
          frMenu.classList.toggle('fr-show');
        });
      }

      // --- Current year ---
      var frYear = document.getElementById('frYear');
      if (frYear) frYear.textContent = new Date().getFullYear();

      // --- Scroll reveal ---
      var frReveals = document.querySelectorAll('.fr-reveal');
      if ('IntersectionObserver' in window && frReveals.length) {
        var frObs = new IntersectionObserver(function (entries) {
          entries.forEach(function (en) {
            if (en.isIntersecting) { en.target.classList.add('fr-in'); frObs.unobserve(en.target); }
          });
        }, { threshold: 0.15 });
        frReveals.forEach(function (el) { frObs.observe(el); });
      } else {
        frReveals.forEach(function (el) { el.classList.add('fr-in'); });
      }

      // --- Animated stat counters ---
      var frNums = document.querySelectorAll('.fr-stat-num[data-count]');
      function frCountUp(el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        var start = 0, dur = 1400, t0 = null;
        function step(ts) {
          if (!t0) t0 = ts;
          var p = Math.min((ts - t0) / dur, 1);
          el.textContent = Math.floor(p * (target - start) + start);
          if (p < 1) requestAnimationFrame(step); else el.textContent = target;
        }
        requestAnimationFrame(step);
      }
      if ('IntersectionObserver' in window && frNums.length) {
        var frNumObs = new IntersectionObserver(function (entries) {
          entries.forEach(function (en) {
            if (en.isIntersecting) { frCountUp(en.target); frNumObs.unobserve(en.target); }
          });
        }, { threshold: 0.5 });
        frNums.forEach(function (el) { frNumObs.observe(el); });
      } else {
        frNums.forEach(function (el) { el.textContent = el.getAttribute('data-count'); });
      }
    </script>
  </body>
</html>
