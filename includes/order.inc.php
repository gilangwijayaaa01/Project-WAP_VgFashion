<?php 

require_once "class_autoloader.php";

/**
 * @param Item $item
 * @param OrderItemContr $cartItem
 * @param int $memberID
*/

function generateOrderDetails($item, $cartItem){
  $itemID = $item->getItemID();
  $quantityInStock = $item->getQuantityInStock();
  $itemName = $item->getName();
  $categoryIdx = $item->getCategory();
  $categoryName = Item::CATEGORY[$categoryIdx];
  $dbh = new Dbhandler();

  $sql = "SELECT I.Image from Items I WHERE I.ItemID = $itemID";
  $result = $dbh->conn()->query($sql) or die($dbh->conn()->error);
  $row = $result->fetch_assoc();
  $image = $row["Image"];

  $dateAdded = $cartItem->getAddedDateTime();
  $price = $cartItem->getPrice();
  $price = "RP" . $price;
  $quantity = $cartItem->getQuantity();
  $quantityDisplay = "x" . $quantity;
  $orderItemID = $cartItem->getOrderItemID();
  
  return [$itemID, $quantity, $quantityInStock, $image, $itemName, $price, $quantityDisplay, $orderItemID, $dateAdded, $categoryName];
}

function generateItem($item, $cartItem, $memberID){

  // admin view orders
  [$itemID, $quantity, $quantityInStock, $image, $itemName, $price, $quantityDisplay, $orderItemID, $dateAdded, $categoryName] 
    = generateOrderDetails($item, $cartItem, $memberID);

  $view_order = isset($_GET["view_order"]);
  echo(
    "
    <li>
      <form method='GET' class='collapsible-header collapsible-card bold center'>
        <input type='hidden' name='member_id' value=$memberID>
        <input type='hidden' name='item_id' value=$itemID>
        <input type='hidden' name='qty' value=$quantity>
        <input type='hidden' name='qty_stock' value=$quantityInStock>

       <!-- Checkbox for Selection -->
        <p class='col s1' style='padding: 0px; margin: 0px;'>
          <label>
            <input type='checkbox' name='selected_items[]' value='$orderItemID' />
            <span></span>
          </label>
        </p>

       <p class='col s2' style='padding: 0px; margin: 0px;'>
          <img class='shadow-img' src='product_images/$image'
            style='height: 60px; width: 80px;'>
        </p>
        <p class='col s3' style='padding: 0px; margin: 0px;'>$itemName</p>
        <p class='col s2 center' style='padding: 0px; margin: 0px;'>$price</p>
        <p class='col s3 center' style='padding: 0px; margin: 0px;'>$quantityDisplay</p>
        <a class='btn orange darken-4 col s2 light-weight-text center' style='margin-right: 5px; padding: 0px;'
          href='product.php?item_id=$itemID'>
          Edit
        </a>"
  );

  if (!$view_order)
  {
    echo(
      "<button class='btn red darken-4 col s2' style='padding: 0px; margin: 0px;'
        name='remove_item' value='$orderItemID'
        onclick=\"return confirm('Are you sure you want remove \'$itemName\'?');\">
        Delete
      </button>"
    );
  }
  echo(
    "</form>
    <div class='collapsible-body row collapsible-card bold' style='margin: 0px;'>
      <div class='col s6'>
        <span>Date Added:</span>
        <span class='light-weight-text'>$dateAdded</span>
      </div>
      <div class='col s6'>
        <span>Category:</span>
        <span class='light-weight-text'>$categoryName</span>
      </div>
    </div>
  </li>"
  );
}

function generateItemList($items, $cartItems, $memberID) {
  echo "<form method='POST' action='process_selection.php'>";
  echo "<ul>";
  foreach ($items as $index => $item) {
    generateItem($item, $cartItems[$index], $memberID);
  }
  echo "</ul>";
  echo "
    <div class='center'>
      <button type='submit' name='action' value='delete_selected' class='btn red darken-4'>
        Delete Selected
      </button>
      <button type='submit' name='action' value='process_selected' class='btn green darken-4'>
        Process Selected
      </button>
    </div>
  ";

  if (!$view_order)
  {
    echo(
      "<a class='btn cyan darken-4 col s2' style='padding: 0px; margin: 0px;'
        href='review.php?review_item=$orderItemID'>
        Review
      </a>"
    );
  }
  echo(
      "</div>
    </li>"
  );
}

function generateOrderSum($totalItems, $sumTotal, $displayShipping, $displaySVoucher, $displayPVoucher)
{
  echo(
    "<div class='col s4'>
      <div class='rounded-card-parent'>
        <div class='card rounded-card tint-glass-brown'>
          <div class='card-content white-text'>
            <h5 class='bold center'>Order Details</h5>
            <table class='responsive-table'>
              <tbody>
                <tr><th>Total Items:</th><td class='left'>$totalItems</td></tr>");
                echo("<tr><th>Delivery Charges:</th><td>");echo("$displayShipping $displaySVoucher</td></tr>");
                echo("<tr><th >Promo Voucher:</th><td >$displayPVoucher</td></tr>");
                echo("<tr><th>Sum Total:</th><td>RM$sumTotal</td></tr>");
                echo("<tr><th>Status:</th><td>Shipped (check email for status)</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>"
  );
}