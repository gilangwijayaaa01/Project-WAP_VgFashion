<footer class="page-footer" style="margin-top: 120px; box-shadow: 0px 0px 2px white; background-color: rgb(17,17,17); padding: 20px 50px">
  <div class="footer-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 20px">
    <div style="col 2">
      <h3 class="wide-container underline" style="text-align: center">VG Fashion</h3>
    </div>
    <div style="col 4">
      <h5 class="white-text bold" style="text-decoration: underline">Support</h5>
      <p>
        <a
          class="dropdown-trigger white-text bold"
          href="#"
          data-target="dropdown1"
          style="text-decoration: none;"
        >
          Customer Care
          <i
            class="material-icons"
            style="
              text-decoration: none !important;
              display: inline-flex;
              vertical-align: top;
            "
            >arrow_drop_down</i
          >
        </a>
      </p>
      <ul id="dropdown1" class="dropdown-content white">
        <li>
          <a href="aboutUs.php" class="black-text bold">About Us</a>
        </li>
        <li class="divider" tabindex="-1"></li>
        <li>
          <a href="warranty_page.php" class="black-text bold">Warranty</a>
        </li>
        <li class="divider" tabindex="-1"></li>
        <li>
          <a href="contactUs.php" class="black-text bold">Contact Us</a>
        </li>
      </ul>
    </div>
    <div style="col 3">
      <h5 class="white-text bold">Find Us</h5>
      <p class="white-text">
        Monday - Sunday :<br />
        11.00am to 8.00pm
      </p>
      <p class="white-text">
        Jalan Kukusan Teknik <br />
        Samping Sutet <br />
        Depok, Jawa Barat, Indonesia.
      </p>
    </div>
    <div style="col 3">
      <h5 class="white-text bold">Our Partners</h5>
      <img
        src="static/images/Patner.jpg"
        alt="Partners"
        style="width: 100%; max-width: 200px; height: auto;"
      />
    </div>
  </div>
  <div class="footer-copyright" style="display: flex; justify-content: center; align-items: center; width: 100%; padding-top: 2px;">
  <div class="col s12" style="text-align: center;">
    <h5 class="wide-container underline" style="font-size: 15px;">
      © 2024 VG Fashion All rights reserved.
    </h5>
  </div>


  <script>
    $(document).ready(function() {
      $('.dropdown-trigger').dropdown({
        coverTrigger: false
      });

      $('#pagination').pageMe({
        pagerSelector:'#myPager',
        activeColor: 'blue',
        prevText:'Previous',
        nextText:'Next',
        showPrevNext:true,
        hidePageNumbers:false,
        perPage:5
      });
      
    })
  </script>

</footer>