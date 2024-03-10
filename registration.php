<?php 
session_start();
if(isset($_SESSION["users"])){
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="style_2.css">

</head>
<body>
    <div class="container">

    <?php
if(isset($_POST["submit"])){
    $LastName = $_POST["LastName"];
    $FirstName = $_POST["FirstName"];
    $Email = $_POST["Email"];
    $password = $_POST["Password"];
    $RepeatPassword = $_POST["Repeat_password"];
    $Country  = $_POST["country"];
    $Province = $_POST["province"];
    $City = $_POST["city_municipality"];
    $Barangay = $_POST["barangay"];
    $Phone = $_POST["phone"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // validate if all fields are empty
    if (empty($LastName) || empty($FirstName) || empty($Email) || empty($password) || empty($RepeatPassword)) {
        $errors[] = "All fields are required";
    }

    // validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email is not valid";
    }

    // validate password length
    if(strlen($password) < 8){
        $errors[] = "Password must be at least 8 characters long";
    }

    // validate if password matches
    if($password != $RepeatPassword){
        $errors[] = "Password does not match";
    }

    require_once "database.php"; // Assuming you have a file named database.php with database connection

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        $errors[] = "Email Already Exist!";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO users (Last_Name, First_Name, Email, Password, Country, Province, City, Barangay, Phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $LastName, $FirstName, $Email, $passwordHash, $Country, $Province, $City, $Barangay, $Phone);
        if(mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'> You are Registered Successfully! </div>";
        } else {
            echo "<div class='alert alert-danger'> Something went wrong</div>";
        }
    }
    mysqli_close($conn); // Close connection after use
}
?>
<form action="registration.php" method="post">

<div class="form-group">
    <input type="text" class="form-control" name="LastName" placeholder="Last Name">
</div>

<div class="form-group">
    <input type="text" class="form-control" name="FirstName" placeholder="First Name">
</div>

<div class="form-group">
    <input type="email" class="form-control" name="Email" placeholder="Email">
</div>

<div class="form-group">
    <input type="password" class="form-control" name="Password" placeholder="Password">
</div>

<div class="form-group">
    <input type="password" class="form-control" name="Repeat_password" placeholder="Repeat Password">
</div>

<!--province and city-->
<div class="form-row">
    <div class="form-group">
        <label>Country</label>
        <select id="countries" name="country" class="form-control" required>
        </select>
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>Province</label>
        <select id="provinces" name="province" class="form-control" required>
            <option value="" disabled selected>Select Province</option>
        </select>
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>City/Municipality</label>
        <select id="cities" name="city_municipality" class="form-control" required>
            <option value="" disabled selected>Select City/Municipality</option>
        </select>
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>Barangay</label>
        <select id="barangay" name="barangay" class="form-control" required>
            <option value="" disabled selected>Select Barangay</option>
        </select>
    </div> <!-- form-group end.// -->
</div>

<div class="form-group">
    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required maxlength="20">
</div>

<div class="form-btn">
    <input type="submit" class="btn btn-primary" value="Register" name="submit">
</div> <!-- form-group// -->

<div class="already-signed-up">
    <p>Already signed up? <a href="login.php">Login Here</a></p>
</div>
</form>
<!--container end.//-->
</div>
    <br><br>
        <script src="./build/js/intlTelInput.js"></script>
        <script src="country.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="province_barangay_city.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var input = document.querySelector("#phone");
                var iti = window.intlTelInput(input, {
                    utilsScript: "./build/js/utils.js",
                    separateDialCode: true,        
                });
 
                // Event listener for handling changes in the input
                input.addEventListener("change", function() {
                    // Check if the input value already contains the dial code
                    if (!input.value.startsWith('+')) {
                        var selectedCountryData = iti.getSelectedCountryData();
                        var countryCode = selectedCountryData.dialCode;
 
                        // Remove leading zeros
                        input.value = input.value.replace(/^0+/, '');
 
                        // Add the dial code only if it's not already present
                        input.value = '+' + countryCode + input.value;
                    }
                });
            });
        </script>

    </div>



    
   
</body>
</html>
