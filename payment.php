<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VG Fashion - Payment</title>
  
  
  <?php 
    include "header.php"; 
    require_once "includes/class_autoloader.php";

    // Fungsi validasi pembayaran
    function validatePayment($virtualAccount, $memberID, $cartID) {
        return strlen($virtualAccount) === 12 && ctype_digit($virtualAccount) && $memberID > 0 && $cartID > 0;
    }

    // Cek jika ada permintaan untuk menghapus cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_cart']) && $_POST['clear_cart'] === 'true') {
      // Hapus cart dari session
      unset($_SESSION['cart']);
      echo json_encode(['status' => 'success']);
      exit(); // Keluar setelah menghapus cart
    }

    if (isset($_GET['checkout']) && $_GET['checkout'] == 'true') {
      $_SESSION['checkout_in_progress'] = true; // Tandai bahwa pengguna sedang dalam proses pembayaran
    }
  
    // Proses pembayaran jika tidak menghapus cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json'); // Set response as JSON
        
        $virtualAccount = $_POST['virtual_account'] ?? null;
        $memberID = (int)($_POST['member_id'] ?? 0);
        $cartID = (int)($_POST['cart_id'] ?? 0);

        if (!$virtualAccount || !$memberID || !$cartID) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit();
        }

        if (!validatePayment($virtualAccount, $memberID, $cartID)) {
            echo json_encode(["status" => "error", "message" => "Invalid payment details"]);
            exit();
        }

        $conn = new Dbhandler();
        try {
            $conn->conn()->beginTransaction();

            // Update status pembayaran pada cart
            $updateCartSQL = "UPDATE Cart SET PaymentStatus = 'PAID' WHERE CartID = ?";
            $stmt = $conn->conn()->prepare($updateCartSQL);
            $stmt->execute([$cartID]);

            // Insert data pembayaran
            $insertPaymentSQL = "INSERT INTO Payment (MemberID, CartID, VirtualAccount, PaymentDate) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->conn()->prepare($insertPaymentSQL);
            $stmt->execute([$memberID, $cartID, $virtualAccount]);

            $conn->conn()->commit();
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            $conn->conn()->rollBack();
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

?>


    

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <style>
    #confirmPayment {
      position: relative;
      z-index: 1000; /* Pastikan tombol berada di atas */
      pointer-events: auto; /* Pastikan tombol bisa diklik */
    }

    body {
      background-color: #2c2c2c;
      color: white;
      font-family: Arial, sans-serif;
    }

    h4.orange-text.bold.center {
      padding-top: 20px;
      margin-bottom: 20px;
      text-align: center;
    }

    .responsive-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table.responsive-table th {
      background-color: rgba(0, 0, 0, 0.8);
      color: white;
      text-align: center;
      padding: 10px;
      border-radius: 5px;
    }

    table.responsive-table td {
      text-align: center;
      padding: 10px;
    }

    .btn-edit {
      background-color: orange;
      color: black;
      font-weight: bold;
      border-radius: 5px;
      padding: 5px 10px;
      transition: background-color 0.3s ease;
    }

    .btn-edit:hover {
      background-color: darkorange;
    }

    .card {
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
      background-color: rgba(56, 56, 56, 0.8);
    }

    .card-content {
      text-align: center;
    }

    .card-content h5 {
      margin-top: 20px;
    }

    img[alt="QR Code"] {
      margin-top: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      border: 5px solid white;
      border-radius: 10px;
    }

    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      color: black;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
      z-index: 1000;
    }

    .modal-footer {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="col s12" style="margin-bottom: 50px;">
      <?php 
        // Memastikan variabel session di-set
        $cartItemCount = isset($_SESSION['cartItemCount']) ? $_SESSION['cartItemCount'] : 0;
        $sumTotal = isset($_SESSION['sumTotal']) ? $_SESSION['sumTotal'] : 0;
        $displayShipping = isset($_SESSION['displayShipping']) ? $_SESSION['displayShipping'] : 0;
        $displayPVoucher = isset($_SESSION['displayPVoucher']) ? $_SESSION['displayPVoucher'] : 0;
        include "static/pages/cart_items.php"; 
      ?>
    </div>

    <div class="selectable-card grey darken-4" id="no-hover">
      <div class="row">
        <h4 class="orange-text bold" style="padding-top: 10px;">Payment</h4>
      </div>
      <div class="col s12" style="margin-top: 30px">
        <div class="rounded-card-parent">
          <div class="card rounded-card">
            <form id="paymentForm">


              <div class="card-content">
                <h5 class="bold white-text">Payment Details</h5>
                <?php
                  $virtualAccount = substr(str_shuffle("0123456789"), 0, 12);
                  echo "<p class='white-text'>Scan the QR Code below or enter the Virtual Account Number to complete your payment.</p>";
                  echo "<h5 class='yellow-text bold'>Virtual Account Number:</h5>";
                  echo "<h4 class='yellow-text bold'>$virtualAccount</h4>";
                ?>
                <div style="margin-top: 20px;">
                  <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?php echo urlencode($virtualAccount); ?>" alt="QR Code">
                </div>
                <p class="white-text" style="margin-top: 20px;">Virtual Account and QR code are valid for 24 hours. Complete your payment promptly to confirm your order.</p>
                <p class="white-text">Supported payment methods: QRIS/E-wallet</p>

              </div>
            </form>
    <form id="paymentForm" method="POST">
      <input type="hidden" name="virtual_account" value="123456789012">
     <input type="hidden" name="member_id" value="1">
      <input type="hidden" name="cart_id" value="101">
     <div class="col s12">
    <button type="submit" id="confirmPayment" class="btn">Confirm Payment</button>
      </div>
       </form>




            <div id="invoiceModal" class="modal">
              <div class="modal-content">
                <h4 class="bold"><i class="fa fa-check-circle" style="color: green;"></i> Payment Verified</h4>
                <p>Thank you for your payment. Below is your transaction summary:</p>
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">Transaction Summary</span>
                    <table class="responsive-table">
                      <tbody>
                        <?php
                          echo("<tr><th>Total Items:</th><td>$cartItemCount</td></tr>");
                          echo("<tr><th>Delivery Charges:</th><td>$displayShipping</td></tr>");
                          echo("<tr><th>Promo Voucher:</th><td>$displayPVoucher</td></tr>");
                          echo("<tr><th>Sum Total:</th><td>RP$sumTotal</td></tr>");
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Modal Footer with Close Button -->
              <div class="modal-footer">
              <a href="#" class="btn green darken-3 modal-close" id="closeAndClearCartBtn">Close</a>
              
              <!-- Formulir penghapusan keranjang (dengan display:none agar tidak terlihat) -->
              <form id="clearCartForm" method="POST" action="payment.php" style="display:none;">
                <input type="hidden" name="clear_cart" value="true">
              </form>
            </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
 document.addEventListener('DOMContentLoaded', function () {
    const confirmPaymentButton = document.getElementById('confirmPayment');
    const paymentForm = document.getElementById('paymentForm');
    const invoiceModal = document.getElementById('invoiceModal');  // Modal element
    const cartItemsContainer = document.getElementById('cartItemsContainer'); // Kontainer item keranjang
    const closeModalButton = document.getElementById('closeAndClearCartBtn'); // Tombol Close
    const clearCartForm = document.getElementById('clearCartForm')
  
    if (!confirmPaymentButton || !paymentForm || !invoiceModal || !closeAndClearCartBtn || !cartItemsContainer || !clearCartForm) {
        console.error('Tombol, form, modal, atau kontainer keranjang tidak ditemukan.');
        return;
    }
  
    confirmPaymentButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default form submission
        const formData = new FormData(paymentForm);

        // Show the modal instead of submitting the form
        invoiceModal.style.display = 'block';  // Display the modal

        fetch('payment.php', {
            method: 'POST',
            body: formData,
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Directly parse JSON response
        })
        .then((data) => {
            if (data.status === 'success') {
                alert('Payment successful!');
                window.location.href = 'payment_done.php'; // Redirect after success
            } else {
                alert('Payment failed: ' + data.message); // Show error message
            }
        });
    });

    closeModalButton.addEventListener('click', function () {
    document.getElementById('invoiceModal').style.display = 'none';
    document.getElementById('clearCartForm').submit(); 
    window.location.href = 'index.php';
    
      // Kirim form untuk menghapus cart setelah modal ditutup
      const clearCartForm = document.getElementById('clearCartForm');
      const formData = new FormData(clearCartForm);
      
      fetch(clearCartForm.action, {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              // Setelah cart dihapus, redirect ke halaman utama
              window.location.href = 'index.php';
          } else {
              alert('Gagal menghapus cart');
          }
      })
      .catch(error => console.error('Error:', error));
  });

});

</script>

</body>
<?php include "footer.php"; ?>
</html>
