<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bai2.1_github";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi và hiển thị lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối đến cơ sở dữ liệu thành công<br>";

    // tạo bảng KHACHHANG
$sql_stmt = "CREATE TABLE IF NOT EXiSTS KHACHHANG (
    MAKH CHAR(4) PRIMARY KEY,
    HOTEN VARCHAR(40),
    DCHI VARCHAR(50),
    SODT VARCHAR(20),
    NGSINH DATE,
    DOANHSO DECIMAL(10,2),
    NGDK DATE
  )";
  $conn->exec($sql_stmt);
  echo "Bảng 'KHACHHANG' đã được tạo thành công.<br>";

  // tạo bảng NHANVIEN
$sql_stmt = "CREATE TABLE IF NOT EXiSTS NHANVIEN (
    MANV CHAR(4) PRIMARY KEY,
    HOTEN VARCHAR(40),
    DTHOAI VARCHAR(20),
    NGVL DATE
  )";
  $conn->exec($sql_stmt);
  echo "Bảng 'NHANVIEN' đã được tạo thành công.<br>";

  // tạo bảng SANPHAM
$sql_stmt = "CREATE TABLE IF NOT EXiSTS SANPHAM (
    MASP CHAR(4) PRIMARY KEY,
    TENSP VARCHAR(40),
    DVT VARCHAR(20),
    NUOCSX VARCHAR(40),
    GIA DECIMAL(10,2)
  )";
  $conn->exec($sql_stmt);
  echo "Bảng 'SANPHAM' đã được tạo thành công.<br>";

  // tạo bảng HOADON
  $sql_stmt = "CREATE TABLE IF NOT EXiSTS HOADON (
    SOHD INT PRIMARY KEY,
    NGHD DATE,
    MAKH CHAR(4),
    MANV CHAR(4),
    TRIGIA DECIMAL(10,2),
    FOREIGN KEY (MAKH) REFERENCES KHACHHANG(MAKH),
    FOREIGN KEY (MANV) REFERENCES NHANVIEN(MANV)
  )";
   $conn->exec($sql_stmt);
   echo "Bảng 'HOADON' đã được tạo thành công.<br>";

   // tạo bảng CTHD
$sql_stmt = "CREATE TABLE IF NOT EXiSTS CTHD (
    SOHD INT,
    MASP CHAR(4),
    SL INT,
    FOREIGN KEY (SOHD) REFERENCES HOADON(SOHD),
    FOREIGN KEY (MASP) REFERENCES SANPHAM(MASP)
  )";
  $conn->exec($sql_stmt);
  echo "Bảng 'CTHD' đã được tạo thành công.<br>";

} catch (PDOException $e) {
    echo "Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage();
}