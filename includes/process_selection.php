<?php
require_once "class_autoloader.php"; // Pastikan class autoloader di-load untuk akses ke class lainnya

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek apakah ada aksi yang dipilih dan item yang diseleksi
    if (isset($_POST['action']) && isset($_POST['selected_items'])) {
        $action = $_POST['action'];
        $selectedItems = $_POST['selected_items']; // Array of selected item IDs

        $dbh = new Dbhandler(); // Contoh untuk database handler

        if ($action === 'delete_selected') {
            // Loop untuk menghapus item berdasarkan ID
            foreach ($selectedItems as $itemID) {
                $sql = "DELETE FROM OrderItems WHERE OrderItemID = ?";
                $stmt = $dbh->conn()->prepare($sql);
                $stmt->bind_param("i", $itemID);
                if ($stmt->execute()) {
                    echo "Item dengan ID $itemID berhasil dihapus.<br>";
                } else {
                    echo "Gagal menghapus item dengan ID $itemID: " . $stmt->error . "<br>";
                }
            }
        } elseif ($action === 'process_selected') {
            // Loop untuk memproses item yang dipilih
            foreach ($selectedItems as $itemID) {
                // Contoh logika untuk update status menjadi 'Processed'
                $sql = "UPDATE OrderItems SET Status = 'Processed' WHERE OrderItemID = ?";
                $stmt = $dbh->conn()->prepare($sql);
                $stmt->bind_param("i", $itemID);
                if ($stmt->execute()) {
                    echo "Item dengan ID $itemID berhasil diproses.<br>";
                } else {
                    echo "Gagal memproses item dengan ID $itemID: " . $stmt->error . "<br>";
                }
            }
        } else {
            echo "Aksi tidak dikenali.";
        }
    } else {
        echo "Tidak ada item yang dipilih.";
    }
} else {
    echo "Invalid request method.";
}
?>
