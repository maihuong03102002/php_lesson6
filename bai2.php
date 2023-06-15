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
// insert bảng Khách hàng
$sql_stmt = "INSERT INTO KHACHHANG (MAKH, HOTEN, DCHI, SODT, NGSINH, DOANHSO, NGDK)
VALUES
('KH01','Nguyen Van A','731 Tran Hung Dao, Q5, TpHCM','08823451','10-22-1960','13,060,000','07-22-2006'),
('KH02','Tran Ngoc Han','23/5 Nguyen Trai, Q5, TpHCM','0908256478','4-3-1974','280,000','07-30-2006'),
('KH03','Tran Ngoc Linh','45 Nguyen Canh Chan, Q1, TpHCM','0938776266','6-12-1980','3,860,000','07-30-2006'),
('KH04','Tran Minh Long','50/34 Le Dai Hanh, Q10, TpHCM','0917325476','3-9-1965','250,000','10-02-2006'),
('KH05','Le Nhat Minh','34 Truong Dinh, Q3, TpHCM','08246108','3-10-1950','21,000', '10-28-2006'),
('KH06','Le Hoai Thuong', '227 Nguyen Van Cu, Q5, TpHCM','08631738','12-31-1981','915,000', '11-24-2006'),
('KH07','Nguyen Van Tam','32/3 Tran Binh Trong, Q5, TpHCM','0916783565','4-6-1971','12,500', '12-01-2006'),
('KH08','Phan Thi Thanh','45/2 An Duong Vuong, Q5, TpHCM',' 0938435756','1-10-1971','365,000', '12-13-2006'),
('KH09','Le Ha Vinh','873 Le Hong Phong, Q5, TpHCM','08654763','9-3-1979','70,000', '01-14-2007'),
('KH10','Ha Duy Lạp.','34/34B Nguyen Trai, Q1, TpHCM','08768904','5-2-1983','67,500 ', '01-16-2007')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm dữ liệu". mysqli_error($dbh));
} else {
    echo "Đã thêm ds Khách hàng thành công</br>";
}

// insert bảng nhân viên
$sql_stmt = "INSERT INTO NHANVIEN (MANV, HOTEN,DTHOAI, NGVL)
VALUES
('NV01','Ngyen Nhu Nhut','0927345678','4-13-2006'),
('NV02','Le Thi Phi Yen','0987567390','4-21-2006'),
('NV03','Nguyen Van B','0997047382 ','4-27-2006'),
('NV04','Ngo Thanh Tuan','0913758498','6-24-2006'),
('NV05','Nguyen Thi Truc Thanh','0918590387','7-20-2006')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm dữ liệu". mysqli_error($dbh));
} else {
    echo "Thêm ds Nhân viên thành công</br>";
}

// insert bảng sản phẩm
$sql_stmt = "INSERT INTO SANPHAM (MASP, TENSP, DVT, NUOCSX, GIA)
VALUES
('BC01','But chi','cay','Singapore','3,000'),
('BC02','But chi','cay','Singapore','5,000'),
('BC03','But chi','cay','Viet Nam','3,500'),
('BC04','But chi','hop','Viet Nam','30,000'),
('BB01','But bi','cay','Viet Nam','5,000'),
('BB02','But bi','cay','Trung Quoc','7,000'),
('BB03','But bi','hop','Thai Lan','100,000'),
('TV01','Tap 100 giay mong','quyen','Trung Quoc','2,500'),
('TV02','Tap 200 giay mong','quyen','Trung Quoc','4,500'),
('TV03','Tap 100 giay tot','quyen','Viet Nam','3,000'),
('TV04','Tap 200 giay mong','quyen','Viet Nam','5,500'),
('TV05','Tap 100 trang','chuc','Viet Nam','23,000'),
('TV06','Tap 200 trang','chuc','Viet Nam','53,000'),
('TV07','Tap 100 trang','chuc','Trung Quoc','34,000'),
('ST01','So tay 500 trang','quyen','Trung Quoc','40,000'),
('ST02','So tay loai 1','quyen','Viet Nam','55,000'),
('ST03','So tay loai 2','quyen','Viet Nam','51,000'),
('ST04','So tay ','quyen','Thai Lan','55,000'),
('ST05','So tay mong','quyen','Thai Lan','20,000'),
('ST06','Phan viet bang','hop','Viet Nam','5,000'),
('ST07','Phan khong bui','hop','Viet Nam','7,000'),
('ST08','Bong bang','cai','Viet Nam','1,000'),
('ST09','But long','cay','Viet Nam','5,000'),
('ST10','But long','cay','Trung Quoc','7,000')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm dữ liệu". mysqli_error($dbh));
} else {
    echo "Thêm ds Sản phẩm thành công</br>";
}

//insert bảng hóa đơn
$sql_stmt = "INSERT INTO HOADON (SOHD, NGHD, MAKH, MANV, TRIGIA)
VALUES
('1001','07-23-2006','KH01','NV01','320,000'),
('1002','08-12-2006','KH01','NV02','840,000'),
('1003','08-23-2006','KH02','NV01','100,000'),
('1004','09-01-2006','KH02','NV01','180,000'),
('1005','10-20-2006','KH01','NV02','3,800,000'),
('1006','10-16-2006','KH01','NV03','2,430,000'),
('1007','10-28-2006','KH03','NV03','510,000'),
('1008','10-28-2006','KH01','NV03','440,000'),
('1009','10-28-2006','KH03','NV04','200,000'),
('1010','11-01-2006','KH01','NV01','5,200,000'),
('1011','11-04-2006','KH04','NV03','250,000'),
('1012','11-30-2006','KH05','NV03','21,000'),
('1013','12-12-2006','KH06','NV01','5,000'),
('1014','12-31-2006','KH03','NV02','3,150,000'),
('1015','01-01-2006','KH06','NV01','910,000'),
('1016','01-01-2006','KH07','NV02','12,500'),
('1017','01-02-2006','KH08','NV03','35,000'),
('1018','01-13-2006','KH08','NV03','330,000'),
('1019','01-13-2006','KH01','NV03','30,000'),
('1020','01-14-2006','KH09','NV04','70,000'),
('1021','01-16-2006','KH10','NV03','67,500')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm dữ liệu". mysqli_error($dbh));
} else {
    echo "Thêm ds Hóa đơn thành công</br>";
}

//insert bảng chi tiết hóa đơn
$sql_stmt = "INSERT INTO CTHD (SOHD, MASP, SL)
VALUES
('1001','TV02','10'),
('1001','ST01','5'),
('1001','BC01','5'),
('1001','BC02','10'),
('1001','ST08','10'),
('1002','BC04','20'),
('1002','BB01','20'),
('1002','BB02','20'),
('1003','BB03','10'),
('1004','TV01','20'),
('1004','TV02','10'),
('1004','TV03','10'),
('1004','TV04','10'),
('1005','TV06','50'),
('1005','TV06','50'),
('1006','TV07','20'),
('1006','ST01','30'),
('1006','ST02','10'),
('1007','ST03','10'),
('1008','ST04','8'),
('1009','ST05','10'),
('1010','TV07','50'),
('1010','ST07','50'),
('1010','ST08','100'),
('1010','ST04','50'),
('1010','TV03','100'),
('1011','ST06','50'),
('1012','ST07','3'),
('1013','ST08','5'),
('1014','BC02','80'),
('1014','BB02','100'),
('1014','BC04','60'),
('1014','BB01','50'),
('1015','BB02','30'),
('1015','BB03','7'),
('1016','TV01','5'),
('1017','TV02','1'),
('1017','TV03','1'),
('1017','TV04','5'),
('1018','ST04','6'),
('1019','ST05','1'),
('1019','ST06','2'),
('1020','ST07','10'),
('1021','ST08','5'),
('1021','TV01','7'),
('1021','TV02','10'),
('1020','ST07','1'),
('1020','ST04','6')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm dữ liệu". mysqli_error($dbh));
} else {
    echo "Thêm Chi tiết hóa đơn thành công</br>";
}