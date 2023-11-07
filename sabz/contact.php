<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'ajax');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create
if(isset($_POST['create'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
    $result = $conn->query($sql);

    if($result){
        echo "Record created successfully!";
    } else {
        echo "Error: " . $sql . "" . $conn->error;
    }
    $conn->close();
}
// Read
if(isset($_POST['read'])){
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $final = [];
    $arr = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $arr = [
              'id' => $row['id'],
              'name' => $row['name'],
              'email' => $row['email'],
              'phone' => $row['phone']
            ];
            array_push($final, $arr);
        }
        var_dump(json_encode($final));
    } else {
        echo "0 results";
    }
    $conn->close();
}

// Update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
    $result = $conn->query($sql);

    if($result){
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $sql . "" . $conn->error;
    }
    $conn->close();
}

// Delete
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id='$id'";
    $result = $conn->query($sql);

    if($result){
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . $sql . "" . $conn->error;
    }
    $conn->close();
}
?>
