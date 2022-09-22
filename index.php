<?php

$dsn = "localhost";
$userName = "root";
$password = "root";
$myDB = "carsInfo";

// connection creation 
$connect = new mysqli($dsn, $userName, $password, $myDB);

// check connetion 
if ($connect->connect_error) {
    die("Faild connection" . $connect->connect_error);
}

// create the database 
// $database = "CREATE DATABASE carsInfo";

// if($connect->query($database) === TRUE){
//     echo "Database created successfully";
// }
// else{
//     echo "Error in creating database :" . $connect->error ;
// }


// Create the cars table 

// $table = "CREATE TABLE Cars (CarID int(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
//           carImage VARCHAR(2083),
//           modle VARCHAR(10), 
//           price INT(100), 
//           color VARCHAR(5))";


// if($connect->query($table) === TRUE){

//     echo "Table created done";
// }
// else {
//     echo "Error creating table :" . $connect->error;
// };

// $connect->close();



// collecting the date form form inputs using super global varibale $_request

// if($_SERVER["REQUEST_METHOD"] == "POST"){

$image = $_REQUEST['image'];
$modle = $_REQUEST['modle'];
$price = $_REQUEST['price'];
$color = $_REQUEST['color'];
// }

// insert the date insider the data base table 
$setData = "INSERT INTO Cars (carImage, modle, price, color) VALUES ('$image', '$modle', '$price', '$color')";
if ($connect->query($setData) === TRUE) {
    echo "new row inserted successfully";
} else {
    echo "Error :" . $setData . "<br>" . $connect->error;
}


// I need to read the rows from the database and display them in a card 

$sql = "SELECT * FROM cars";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {

?>

        <div style="border:2px red solid; width:200px; height:200px;">
            <img style="width:30px; height:30px;" src="<?php echo $row['carImage'] ?>">
            <p><?php echo "car modle :" . $row['modle'] ?></p>
            <p><?php echo "rent price / day :" . $row['price'] ?></p>
            <p><?php echo "car color : " . $row['color'] ?></p>
        </div>

<?php
    }
} else {
    echo "no rcord exisits!";
}

$connect->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Dealership</title>
</head>

<body style="text-align:center;">

    <!-- create simple header -->
    <h1 style="font-family:fantasy; color:darkorange"> Cars Dealership </h1>

    <!-- create the form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <label for="carImage">Car Image</label>
        <input name="image" style="margin: 20px;" id="carImage" type="text" required> <br>

        <label for="modle">Car Modle</label>
        <input name="modle" style="margin: 20px;" id="modle" type="text"> <br>

        <label for="price">Rent Price</label>
        <input name="price" style="margin: 20px;" id="price" type="number"> <br>

        <label style="padding-right:30px ;" for="color">Color</label>
        <input name="color" style="margin: 20px;" id="color" type="text"> <br>

        <input style="margin-left:145px ;" type="submit" value="Add For Rent">
    </form>




</body>

</html>