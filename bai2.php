<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bai2_phpt4';

//kết nối tới MySQL server
$dbh = mysqli_connect ($servername, $username, $password);

// kết nối thất bại thông báo lỗi
if (!$dbh){
    die("không thể kết nối đến MySQL" . mysqli_error());
}

// thông báo lỗi nếu chọn CSDL thất bại
if (!mysqli_select_db($dbh,$dbname)){
    die("không thể chọn CSDL". mysqli_error($dbh));
}

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
  $result = mysqli_query($dbh,$sql_stmt);
  if (!$result){
      die ("lỗi khi tạo bảng". mysqli_error($dbh));
  } else {
      echo "Đã tạo bảng khách hàng thành công</br>";
  }
// tạo bảng NHANVIEN
$sql_stmt = "CREATE TABLE IF NOT EXiSTS NHANVIEN (
    MANV CHAR(4) PRIMARY KEY,
    HOTEN VARCHAR(40),
    DTHOAI VARCHAR(20),
    NGVL DATE
  )";
  $result = mysqli_query($dbh,$sql_stmt);
  if (!$result){
      die ("lỗi khi tạo bảng". mysqli_error($dbh));
  } else {
      echo "Đã tạo bảng nhân viên thành công</br>";
  }
// tạo bảng SANPHAM
$sql_stmt = "CREATE TABLE IF NOT EXiSTS SANPHAM (
    MASP CHAR(4) PRIMARY KEY,
    TENSP VARCHAR(40),
    DVT VARCHAR(20),
    NUOCSX VARCHAR(40),
    GIA DECIMAL(10,2)
  )";
  $result = mysqli_query($dbh,$sql_stmt);
  if (!$result){
      die ("lỗi khi tạo bảng". mysqli_error($dbh));
  } else {
      echo "Đã tạo bảng sản phẩm thành công</br>";
  }
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
  $result = mysqli_query($dbh,$sql_stmt);
  if (!$result){
      die ("lỗi khi tạo bảng". mysqli_error($dbh));
  } else {
      echo "Đã tạo bảng hóa đơn thành công</br>";
  }
// tạo bảng CTHD
$sql_stmt = "CREATE TABLE IF NOT EXiSTS CTHD (
    SOHD INT,
    MASP CHAR(4),
    SL INT,
    FOREIGN KEY (SOHD) REFERENCES HOADON(SOHD),
    FOREIGN KEY (MASP) REFERENCES SANPHAM(MASP)
  )";
  $result = mysqli_query($dbh,$sql_stmt);
  if (!$result){
      die ("lỗi khi tạo bảng". mysqli_error($dbh));
  } else {
      echo "Đã tạo bảng chi tiết đơn hàng thành công</br>";
  }