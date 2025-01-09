<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>VG Fashion- Landing Page</title>
  <?php 
    require "header.php"; 
    require_once "includes/class_autoloader.php";

    // database initialization
    $dbinit = new InitDB();
    $dbinit->initDbExec();
  ?>
</head>
<body>
  <div class="slider" style="width: 100%; height: auto">
    <ul class="slides">
      <li>
        <img src="./static/images/slide1.gif"> 
        <div class="caption center-align"> 
          <h3></h3>
          <h5 class="light red-text text-lighten-3">Build your dream Fashion with Us.</h5>
        </div>
      </li>
      <li>
        <img src="./static/images/slide2.gif" > 
        <div class="caption center-align">
          <h3 class="bold page-title"></h3>
          <h5 class="light grey-text text-lighten-3">Apart from that, we also provide accessories.</h5>
        </div>
      </li>
      <li>
        <img src="static/images/FREE SHIPING.gif"> 
      </li>
      <li>
        <img src="./static/images/slide3.gif"> 
        <div class="caption center-align">
          <h3 class="light grey-text text-lighten-3">We provide clothing for men and women.</h3>
        </div>
      </li>
      <li>
        <img src="./static/images/discount.gif"> 
        <div class="caption center-align">
        </div>
      </li>
    </ul>
  </div>
  
  <div class="container" style="margin-top: 100px">
    <div class="row">
      <div class="row" style="margin-bottom: -20px">
        <h4 class="underline white-text bold center">Categories</h4>
      </div>

      
      <div class="row" style=" display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 50px">
        <div class="col hoverable" style="flex: 1 1 calc(33.33% - 20px); max-width: 300px; text-align: center; margin-bottom: 20px">
          <a href="product_catalogue.php?category=0" style="text-decoration: none; color: inherit">
            <div class="selectable-card hoverable" style="margin: auto; border-radius: 10px; overflow: hidden; background-color: #1a1a1a">
                <img class="hoverable" src="static/images/Relaxed Fit Embroidered sweatshirt.jpg" style="width: 100%; height: auto; border-bottom: 2px solid #ffffff"/>
              <h5 class="white-text center bold hoverable" style="margin: 15px 0; color: white">MEN </h5>
            </div>
          </a>
        </div>

        <div class="col hoverable" style="flex: 1 1 calc(33.33% - 20px); max-width: 300px; text-align: center; margin-bottom: 20px">
          <a href="product_catalogue.php?category=0" style="text-decoration: none; color: inherit">
            <div class="selectable-card hoverable" style="margin: auto; border-radius: 10px; overflow: hidden; background-color: #1a1a1a">
                <img class="hoverable" src="static/images/Lace-up collared jumper.jpg" style="width: 100%; height: auto; border-bottom: 2px solid #ffffff"/>
              <h5 class="white-text center bold hoverable" style="margin: 15px 0; color: white">WOMEN </h5>
            </div>
          </a>
        </div>
        
        <div class="col hoverable" style="flex: 1 1 calc(33.33% - 20px); max-width: 310px; text-align: center; margin-bottom: 20px">
          <a href="product_catalogue.php?category=0" style="text-decoration: none; color: inherit">
            <div class="selectable-card hoverable" style="margin: auto; border-radius: 10px; overflow: hidden; background-color: #1a1a1a">
                <img class="hoverable" src="./static/images/Diamond earrings made in the effect of the riam.jpg" style="width: 100%; height: auto; border-bottom: 2px solid #ffffff"/>
              <h5 class="white-text center bold hoverable" style="margin: 15px 0; color: white">ACCECORIS</h5>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="section" style="margin-top: 100px;">
    <div class="wide-container">
      <h3 class="white-text center">BUILT BY ENTHUSIASTS FOR ENTHUSIASTS</h3>
      <h5 class="white-text center">
        At <b class="orange-text">VG Fashion</b>, We are a team of fashion enthusiasts and style innovators driven by a passion for creating unique, statement-making pieces that set you apart.
      </h5>
    </div>
  </div>

  <div class="grid" style="margin-top: 20px; margin-bottom: 100px; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px;">
    <div class="grid-item" style="flex: 1 1 200px; text-align: center;">
      <h1 class="count red-text text-darken-4 bold center">15</h1>
      <h5 class="white-text center">Years Of History</h5>
    </div>
    <div class="grid-item" style="flex: 1 1 200px; text-align: center;">
      <h1 class="count red-text text-darken-4 bold center">10000</h1>
      <h5 class="white-text center">PCs Built</h5>
    </div>
    <div class="grid-item" style="flex: 1 1 200px; text-align: center;">
      <h1 class="count red-text text-darken-4 bold center">14</h1>
      <h5 class="white-text center">States Covered</h5>
    </div>
    <div class="grid-item" style="flex: 1 1 200px; text-align: center;">
      <h1 class="count red-text text-darken-4 bold center">100</h1>
      <h5 class="white-text center">% Satisfaction guaranteed</h5>
    </div>
  </div>

  </div>


  <h3 class="white-text center">VG Fashion - Couple Set</h3>
  <div onclick="this.nextElementSibling.style.display='block'; this.style.display='none'" style="margin-bottom: 100px">
    <img src="static/images/ice.jpg" style="cursor:pointer; display:block; margin: 0 auto; " />
  </div>
  <div style="display:none">
    <div class="video-container" style="position:relative; width:100%; height:0; padding-bottom:56.25%; overflow:hidden">
      <video class="responsive-video" style="position:absolute; top:0; left:0; width:100%; height:100%;" autoplay="autoplay" controls muted>
        <source src="static/couple.mp4" type="video/mp4">
      </video>
    </div>
  </div>
  
  <h3 class="white-text center">OUR DIFFERENCE</h3>
  <div class="grid" style="margin-bottom: 0px;">
  <div class="grid">
      <div class="rounded-card-parent">
        <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
          <img src="static/images/values_images/T.svg" height="200px">
          <div class="row center">
            <h5 class="orange-text bold center" style="display: inline;">G</h5>
            <h5 class="white-text bold center" style="display: inline;">uaranteed Return/Warranty</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="grid">
      <div class="rounded-card-parent">
        <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
          <img src="static/images/values_images/Rebate.png" height="200px">
          <div class="row center">
            <h5 class="orange-text bold center" style="display: inline;">F</h5>
            <h5 class="white-text bold center" style="display: inline;">ree Shipping Se-Kutek</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="grid">
      <div class="rounded-card-parent">
        <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
          <img src="static/images/values_images/S.svg" height="200px">
          <div class="row center">
            <h5 class="orange-text bold center" style="display: inline;">A</h5>
            <h5 class="white-text bold center" style="display: inline;">uthentic 100% Original</h5>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-dcc4934e-3eb0-4e18-98af-67fd2f034df1"></div>

  <?php require "footer.php"; ?>
</body>

<script>
  $(document).ready(function(){
    // carousel autoswipe
    $('.slider').slider({full_width: true});

    // counter
    $('.count').each(function () 
    {
      $(this).prop('Counter',0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) { $(this).text(Math.ceil(now)); }
      });
    });
  });
</script>
</html>