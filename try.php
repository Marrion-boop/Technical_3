<html>
<?php


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: user.php");
    exit;
}

?>

<body>


<form method="POST">
<h3>My Personal Information </h3>
First Name<br> <input type="text" name="first_name"><br>
Middle Name<br><input type="text" name="middle_name"><br>
Last Name<br><input type="text" name="last_name"><br>
Username<br><input type="text" name="user_name"><br>
Password<br><input type="password" name="pass_word"><br>
Confirm Password<br><input type="password" name="c_pass_word"><br>
Birthday<br><input type="date" name="birthday"><br>
E-mail<br><input type="email" name="e_mail" placeholder="myemail@gmail.com"><br>
Contact Number<br><input type="tel" name="contact_number" placeholder="0912-345-6789" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required><br>
<input type="submit">
</form>
<a href="front.php">
    <button>Log In</button>
</a>
<?php

include "db_connection.php";

$conn = OpenCon();


$password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!(($_POST["pass_word"]) == ($_POST["c_pass_word"])))
    {
        $password_err = "Password and confirm password are not the same";
        
    }
    if(empty($password_err))
        {
            $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $pass_word = $_POST["pass_word"];
        $user_name = $_POST["user_name"];
        $birthday = $_POST["birthday"];
        $e_mail = $_POST["e_mail"];
        $contact_number = $_POST["contact_number"];
            $sql = "Insert INTO accInfo (first_name, middle_name, last_name, user_name,pass_word,contact_number,birth_date,email) VALUES ('$first_name', '$middle_name', '$last_name','$user_name', '$pass_word', '$contact_number', $birthday, '$e_mail')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    
        }
    else
    {
        echo "Password and confirm password are not the same";
    }

        
        
}
CloseCon($conn);

?>




</body>
</html>