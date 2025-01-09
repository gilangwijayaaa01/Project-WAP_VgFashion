<?php

  require_once "includes/order.inc.php";
  require_once "includes/class_autoloader.php";

  if (isset($_GET["member_id"])) {
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID);
    $cart = $member->getCart();
    $cartID = $cart->getOrderID();
    $cartItems = $cart->getOrderItems();
    $cartItemCount = count($cartItems);
  }

  if (isset($_GET["remove_item"])) {
      $orderItemID = $_GET["remove_item"];
      $sql = "DELETE FROM OrderItems WHERE OrderItemID = $orderItemID";
      $conn = new Dbhandler();
      $conn->conn()->query($sql) or die($conn->conn()->error);
      header("location: cart.php?member_id=$memberID");
  }

  
?>


<h4 class="page-title">Cart</h4>
<div class="row">
  <div class="col s12">
    <ul class="collapsible popout" id="cart">
      <!-- Header di atas daftar produk -->
      <div id="cartHeader" style="
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        background-color: #333; 
        color: #fff; 
        padding: 10px 15px; 
        border-radius: 8px; 
        margin-bottom: 10px; 
        font-size: 14px;
      ">
        <p style="flex: 2; text-align: center; margin: 0;">Product</p>
        <p style="flex: 1; text-align: center; margin: 0;">Unit Price</p>
        <p style="flex: 1; text-align: center; margin: 0;">Quantity</p>
        <p style="flex: 1; text-align: center; margin: 0;">Actions</p>
      </div>

      <!-- Membungkus konten item keranjang dengan id cartItemsContainer -->
      <div id="cartItemsContainer">
        <?php
          if (isset($cartItems)) {
            if ($cartItemCount <= 0) {
              echo("<h5 class='grey-text page-title'>Your shopping cart is empty.</h5>
                    <h6 class='grey-text page-title'>
                      <a href='product_catalogue.php?query='>Shop Now!</a>
                    </h6>");
            } else if ($cartItemCount >= 0) {
              $sumTotal = 0;
              for ($c=0; $c < $cartItemCount; $c++) {
                $orderItem = $cartItems[$c];
                $item = new Item($orderItem->getItemID());
                generateItem($item, $orderItem, $memberID);

                $quantity = $orderItem->getQuantity();
                $price = $orderItem->getPrice();
                $sumTotal += $price * $quantity;

              }
            }
          }
        ?>
    </ul>
  </div>

  <?php if (!isset($_GET["view_order"]) && $cartItemCount > 0) { ?>
    <!-- Tombol Checkout -->
    <form id="cartForm" action="payment.php" method="GET">
      <input type="hidden" name="order_id" value="<?php echo($cartID); ?>">
      <input type="hidden" name="member_id" value="<?php echo($memberID); ?>">
      <button type="submit" id="checkoutButton" class="btn amber darken-3 col s12" >
        Checkout
      </button>
    </form>
  <?php } ?>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    const itemCheckboxes = document.querySelectorAll(".itemCheckbox");
    const checkoutButton = document.getElementById("checkoutButton");

    // Fungsi untuk mengecek apakah ada checkbox yang dicent

    // Menambahkan event listener ke setiap checkbox
    itemCheckboxes.forEach((checkbox) => {
      checkbox.addEventListener("change", toggleCheckoutButton);
    });

    // Inisialisasi tombol Checkout saat halaman dimuat
    toggleCheckoutButton();
  });
</script>
