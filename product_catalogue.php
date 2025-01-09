<!DOCTYPE html>
<html lang="en">
<body>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VG Fashion - Product Catalogue</title>
    <?php 
      require_once "header.php";
      require_once "includes/product_catalogue.inc.php";
    ?>
  </head>

  <main>
    <div class="row" style="padding-top: 15px;">
      <div class="col s2 center">
        <div id="rgb_hover" style="position: fixed;">
          <form id="form-filter" action="" method="GET">
            <!-- Hidden query parameter -->
            <input type="hidden" name="query" value="<?php echo isset($_GET["query"]) ? htmlspecialchars($_GET["query"]) : ''; ?>">

            <!-- Filter by Category -->
            <div class="section" style="margin-bottom: 100px;">
              <div class="col unglow">
                <ul id="filter_dropdown" class="dropdown-content black">
                <li><a class="cyan-text page-title" onclick="select_category(this)">Clear</a></li>
                  <li><a class="cyan-text page-title" onclick="select_category(this)">MEN</a></li>
                  <li><a class="cyan-text page-title" onclick="select_category(this)">WOMEN</a></li>
                  <li><a class="cyan-text page-title" onclick="select_category(this)">ACCECORIES</a></li>
                </ul>
                <a class="btn dropdown-trigger cyan" data-target="filter_dropdown" style="margin-top: 5px;">
                  <?php
                    $category = isset($_GET["category"]) ? intval($_GET["category"]) : -1;
                    echo $category != -1 ? CATEGORY_NAMES[$category] : "Select Category";
                  ?>
                </a>
                <input type="hidden" name="category" id="category-input" value="<?php echo $category; ?>">
              </div>
            </div>

            <!-- Sort by Price -->
            <div class="section" style="margin-bottom: 100px;">
              <div class="col unglow">
                <ul id="sort_dropdown" class="dropdown-content black">
                <li><a class="page-title" onclick="select_sort(this)">Clear</a></li>
                  <li><a class="page-title" onclick="select_sort(this)">Price low to high</a></li>
                  <li><a class="page-title" onclick="select_sort(this)">Price high to low</a></li>
                </ul>
                <a class="btn dropdown-trigger cyan" data-target="sort_dropdown" style="margin-top: 5px;">
                  <?php
                    $sort = isset($_GET["sort"]) ? intval($_GET["sort"]) : -1;
                    echo $sort != -1 ? SORT_NAMES[$sort] : "Select Sort Type";
                  ?>
                </a>
                <input type="hidden" name="sort" id="sort-input" value="<?php echo $sort; ?>">
              </div>
            </div>

            <!-- Filter by Brand -->
            <div class="section">
              <div class="col unglow">
                <ul id="choose_dropdown" class="dropdown-content black">
                <li><a class="cyan-text page-title" onclick="select_brand(this)">Clear</a></li>
                  <li><a class="cyan-text page-title" onclick="select_brand(this)">Uniqlo</a></li>
                  <li><a class="cyan-text page-title" onclick="select_brand(this)">H&M</a></li>
                  <li><a class="cyan-text page-title" onclick="select_brand(this)">Zara</a></li>
                  <li><a class="cyan-text page-title" onclick="select_brand(this)">Stadivarius</a></li>
                </ul>
                <a class="btn dropdown-trigger cyan" data-target="choose_dropdown" style="margin-top: 5px;">
                  <?php
                    $brand = isset($_GET["brand"]) ? intval($_GET["brand"]) : -1;
                    echo $brand != -1 ? BRAND_NAMES[$brand] : "Select Brand";
                  ?>
                </a>
                <input type="hidden" name="brand" id="brand-input" value="<?php echo $brand; ?>">
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Item List -->
      <div class="col s9" style="margin-bottom: 80px">
        <?php
          searchItems($category, $brand, $sort);
        ?>
      </div>
    </div>
  </main>
</body>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.dropdown-trigger');
    M.Dropdown.init(elems);

    form = document.getElementById("form-filter");
    categoryInput = document.getElementById("category-input");
    brandInput = document.getElementById("brand-input");
    sortInput = document.getElementById("sort-input");
  });

  var form, categoryInput, brandInput, sortInput;

  var categoryBy = {
    "Clear": -1,
    "MEN": 0,
    "WOMEN": 1,
    "ACCECORIES": 2
  };

  var brandBy = {
    "Clear": -1,
    "Uniqlo": 0,
    "H&M": 1,
    "Zara": 2,
    "Stadivarius": 3
  };

  var sortBy = {
    "Clear": -1,
    "Price low to high": 0,
    "Price high to low": 1
  };

  function select_category(selectedItem) {
    var categoryID = categoryBy[selectedItem.textContent.trim()];
    if (categoryID !== undefined) {
      categoryInput.value = categoryID;
      form.submit();
    }
  }

  function select_brand(selectedBrand) {
    var brandID = brandBy[selectedBrand.textContent.trim()];
    if (brandID !== undefined) {
      brandInput.value = brandID;
      form.submit();
    }
  }

  function select_sort(selectedSort) {
    var sortID = sortBy[selectedSort.textContent.trim()];
    if (sortID !== undefined) {
      sortInput.value = sortID;
      form.submit();
    }
  }
</script>

<?php include_once "footer.php"; ?>
</html>
