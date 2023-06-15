<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hocphp_thu4';

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

// tạo bảng "customer"
$sql_stmt = "CREATE TABLE IF NOT EXiSTS CUSTOMER (
    ID  int NOT NULL ,
    NAME varchar(255) NOT NULL,
    EMAIL varchar(255) NOT NULL,
    PHONE varchar(255) NOT NULL,
    PRIMARY KEY (ID) 
)";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi tạo bảng". mysqli_error($dbh));
} else {
    echo "Đã tạo bảng customer thành công</br>";
}

// thêm 5 khách hàng mới vào bảng
$sql_stmt = "INSERT INTO CUSTOMER (ID, NAME, EMAIL, PHONE)
VALUES
('1','Emily Johnson', 'emily.johnson@example.com', '1111111111'),
('2','Sophia Davis', 'sophia.davis@example.com', '2222222222'),
('3','Olivia Wilson', 'olivia.wilson@example.com', '3333333333'),
('4','Emma Taylor', 'emma.taylor@example.com', '4444444444'),
('5','Ava Anderson', 'ava.anderson@example.com', '5555555555')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm dữ liệu". mysqli_error($dbh));
} else {
    echo "Đã thêm 5 khách hàng thành công</br>";
}

// sửa thông tin của 1 khách hàng có id là 1
$sql_stmt = "UPDATE CUSTOMER
SET name = 'MAI HƯƠNG', email = 'mai.huong@example.com', phone = '887654321'
WHERE ID = 1";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi sửa thông tin". mysqli_error($dbh));
} else {
    echo "Sửa thông tin khách hàng thành công</br>";
}

// Xóa 1 khách hàng có id là 1
$sql_stmt = "DELETE FROM CUSTOMER
WHERE ID = 5";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi xóa thông tin". mysqli_error($dbh));
} else {
    echo "Xóa thông tin thành công</br>";
}

// Lấy tất cả các khách hàng có email là "example@gmail.com"
$sql_stmt = "SELECT * FROM CUSTOMER
WHERE EMAIL = 'olivia.wilson@example.com'";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi lấy thông tin". mysqli_error($dbh));
} else {
    echo "Lấy email khách hàng thành công</br>";
}

//Tạo bảng "orders" (Thêm ràng buộc cho khoá ngoại delete cascade)
$sql_stmt = "CREATE TABLE IF NOT EXiSTS ORDERS (
    ID INT PRIMARY KEY,
    CUSTOMER_ID INT,
    TOTAL_AMOUNT DECIMAL(10, 2),
    ORDER_DATE DATE,
    CONSTRAINT FK_CUSTOMER
    FOREIGN KEY (CUSTOMER_ID)
    REFERENCES CUSTOMER(ID)
    ON DELETE CASCADE
    )";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi tạo bảng". mysqli_error($dbh));
} else {
    echo "Đã tạo bảng orders thành công</br>";
}

//Thêm một đơn hàng mới vào bảng "orders" cho khách hàng có id là 3
$sql_stmt = "INSERT INTO ORDERS  (ID, CUSTOMER_ID, TOTAL_AMOUNT, ORDER_DATE)
VALUES
('1', '3', '100.000', '2023-06-15')";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi thêm đơn hàng". mysqli_error($dbh));
} else {
    echo "Thêm đơn hàng thành công</br>";
}

//Lấy tất cả các đơn hàng của khách hàng có id là 3
$sql_stmt = "SELECT * FROM ORDERS 
WHERE CUSTOMER_ID = 3";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi xem đơn hàng". mysqli_error($dbh));
} else {
    echo "Xem đơn hàng của khách thành công</br>";
}

//Lấy danh sách khách hàng và đơn hàng của họ
$sql_stmt = "SELECT CUSTOMER.ID, CUSTOMER.NAME, CUSTOMER.EMAIL, CUSTOMER.PHONE, ORDERS.ID AS ORDER_ID, ORDERS.TOTAL_AMOUNT, ORDERS.ORDER_DATE
FROM CUSTOMER
JOIN orders ON CUSTOMER.ID = ORDERS.CUSTOMER_ID";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi lấy đanh sách và đơn hàng". mysqli_error($dbh));
} else {
    echo "Lấy danh sách và đơn hàng thành công</br>";
}

//Lấy danh sách email của khách hàng
$sql_stmt = "SELECT DISTINCT NAME,EMAIL FROM CUSTOMER";
$result = mysqli_query($dbh,$sql_stmt);
if (!$result){
    die ("lỗi khi lấy danh sách". mysqli_error($dbh));
} else {
    echo "lấy danh sách email thành công</br>";
}