<?php include 'include/header.php'; ?>

    <section class="hero" style="background: linear-gradient(to right, #FEE0D9, #C674F6);">
      <div class="container">
        <div class="hero__image" style="background:url('hero.png');background-size: cover; object-fit: cover;"></div>

        <div class="hero__text container--pall">
          <h1>Fire Rescue Response System</h1>
          <p class="text-dark">
             A web-based application that allows users to report complaints to the Rescue Control Center.Users take real-time image and send them, along with their GPS Location, to the Rescue control center. 
          </p>
          <a href="complaint.php" class="button hero__cta">Urgent Complaint</a>
        </div>
      </div>
    </section>
<hr>

    <section class="articles">
      <div class="article__content container container--pall">
        <h2>Most Common Causes of House Fires</h2>

        <div class="article__grid">
          <a href="#" class="article__item">
            <div
              class="article__image"
              style="background-image: url('assets/img/smoking.jpg')"
            ></div>
            <div class="article__text">
              <div class="article__author"></div>
              <div class="article__title">
              Smoking
              </div>
              <div class="article__description">
                 People sometimes fall asleep while smoking. In doing so, they can set their bed, chair or couch on fire, which can easily result in a fatality.
              </div>
            </div>
          </a>

          <a href="#" class="article__item">
            <div
              class="article__image"
              style="background-image: url('assets/img/appliance.jpg')"
            ></div>
            <div class="article__text">
              <div class="article__author"></div>
              <div class="article__title">
                Appliances and Equipment
              </div>
              <div class="article__description">
                Any device that generates heat (stoves, clothes dryers, heaters) or heats up with extended use (computers, fans) is a potential fire hazard. 
              </div>
            </div>
          </a>

          <a href="#" class="article__item">
            <div
              class="article__image"
              style="background-image: url('assets/img/candles.jpg');"></div>
            <div class="article__text">
              <div class="article__author"></div>
              <div class="article__title">
                Candles
              </div>
              <div class="article__description">
                Every candle comes with a warning: “a burning candle should never be left unattended.” Yet, many candles are often forgotten and can burn out of control.
              </div>
            </div>
          </a>

          <a href="#" class="article__item">
            <div
              class="article__image"
              style="background-image: url('assets/img/electirc.jpg')"
            ></div>
            <div class="article__text">
              <div class="article__author"></div>
              <div class="article__title">
                Electrical Systems and Devices
              </div>
              <div class="article__description">
                Shoddy electrical work within a home — poorly connected circuits, loose wires, improper grounding — is also a danger often unknown to homeowners.
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>
<hr>

    <footer class="footer">
      <div class="container">
        <a class="footer__logo" href="#">
          <img src="assets/img/station.png" width="200px" />
        </a>

        <div class="footer__links col2">
          <a href="index.php">Home</a>
          <a href="about_us.php">About Us</a>
          <a href="posts.php">Posts </a>
        </div>

        <div class="footer__cta">
          <a href="complaint.php" class="button">Urgent Complaint</a>
        </div>
      </div>

      <div class="attribution">
        <hr>
        Fire Rescue Response System.
      </div>
    </footer>

    <script src="assets/app/js/script.js"></script>
  </body>
</html>
