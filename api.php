<?php
header("Content-Type: application/json");

$servername = "localhost";  // Nama server, jika di localhost, bisa tetap "localhost"
$username = "root";         // Username MySQL, default "root" jika belum diganti
$password = "";             // Password MySQL, kosong jika belum diganti
$dbname = "assential";      // Nama database Anda

try {
    // Membuat koneksi ke database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Ambil data dari tabel user
    $stmt = $conn->prepare("SELECT * FROM user");
    $stmt->execute();
    $user_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Ambil data dari tabel tempat_wisata
    $stmt = $conn->prepare("SELECT * FROM tempat_wisata");
    $stmt->execute();
    $tempat_wisata_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Ambil data dari tabel payment
    $stmt = $conn->prepare("SELECT * FROM payment");
    $stmt->execute();
    $payment_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 4. Ambil data dari tabel kategori_hotel
    $stmt = $conn->prepare("SELECT * FROM kategori_hotel");
    $stmt->execute();
    $kategori_hotel_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 5. Ambil data dari tabel hotel_rekomendasi
    $stmt = $conn->prepare("SELECT * FROM hotel_rekomendasi");
    $stmt->execute();
    $hotel_rekomendasi_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 6. Ambil data dari tabel favorites
    $stmt = $conn->prepare("SELECT * FROM favorites");
    $stmt->execute();
    $favorites_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 7. Ambil data dari tabel detail_hotel
    $stmt = $conn->prepare("SELECT * FROM detail_hotel");
    $stmt->execute();
    $detail_hotel_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 8. Ambil data dari tabel booking
    $stmt = $conn->prepare("SELECT * FROM booking");
    $stmt->execute();
    $booking_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Menggabungkan semua hasil menjadi satu array
    $result = [
        "user" => $user_result,
        "tempat_wisata" => $tempat_wisata_result,
        "payment" => $payment_result,
        "kategori_hotel" => $kategori_hotel_result,
        "hotel_rekomendasi" => $hotel_rekomendasi_result,
        "favorites" => $favorites_result,
        "detail_hotel" => $detail_hotel_result,
        "booking" => $booking_result
    ];

    // Menampilkan hasil dalam format JSON
    echo json_encode($result);

} catch(PDOException $e) {
    // Jika ada error, tampilkan pesan error dalam format JSON
    echo json_encode(["error" => $e->getMessage()]);
}
?>
