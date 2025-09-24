<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = $_POST["email"];
    $password = $_POST["password"];

    // Ambil data user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // verifikasi password (gunakan password_verify kalau password disimpan dengan hash)
        if (password_verify($password, $user["password"])) {
            // login sukses
            $_SESSION["username"] = $user["username"];
            $_SESSION["user_id"] = $user["id"];
            // redirect ke dashboard / halaman setelah login
            header("Location: Dashboard.html");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak terdaftar.";
    }
} else {
    echo "Metode tidak valid.";
}
?>
