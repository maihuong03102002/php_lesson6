<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bai1.1_github";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi và hiển thị lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối đến cơ sở dữ liệu thành công<br>";

    // Tạo bảng "customers"
    $sqlCreateTableCustomers = "CREATE TABLE customers (
        id INT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        phone VARCHAR(255)
    )";

    $conn->exec($sqlCreateTableCustomers);
    echo "Bảng 'customers' đã được tạo thành công.<br>";

    // Thêm 5 khách hàng mới vào bảng "customers"
    $sqlAddCustomers = "INSERT INTO customers (id, name, email, phone) VALUES
        ('1','Emily Johnson', 'emily.johnson@example.com', '1111111111'),
        ('2','Sophia Davis', 'sophia.davis@example.com', '2222222222'),
        ('3','Olivia Wilson', 'olivia.wilson@example.com', '3333333333'),
        ('4','Emma Taylor', 'emma.taylor@example.com', '4444444444'),
        ('5','Ava Anderson', 'ava.anderson@example.com', '5555555555')";

    $conn->exec($sqlAddCustomers);
    echo "Thêm khách hàng thành công.<br>";

    // Sửa thông tin của một khách hàng có id là 1
    $sqlUpdateCustomers = "UPDATE customers SET name = 'Updated Name', email = 'updatedemail@example.com', phone = '999999999' WHERE id = 1";
    $conn->exec($sqlUpdateCustomers);
    echo "Thông tin khách hàng đã được cập nhật thành công.<br>";

    // Xoá một khách hàng có id là 5
    $sqlDeleteCustomers = "DELETE FROM customers WHERE id = 5";
    $conn->exec($sqlDeleteCustomers);
    echo "Xoá khách hàng thành công.<br>";

    // Lấy tất cả các khách hàng có email là "example@gmail.com"
    $sqlSelectCustomers = "SELECT * FROM customers WHERE email = 'example@gmail.com'";
    $result = $conn->query($sqlSelectCustomers);

    if ($result->rowCount() > 0) {
        echo "Các khách hàng có email 'example@gmail.com':<br>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row["id"] . "<br>". "Name: " . $row["name"] . "<br>". "Email: " . $row["email"] ."<br>". "Phone: " . $row["phone"] . "<br>";
        }
    } else {
        echo "Không tìm thấy khách hàng có email 'example@gmail.com'.<br>";
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage();
}