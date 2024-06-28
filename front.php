<html>
<body>

<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: user.php");
    exit;
}

?>

<form method="POST">
Userame: <input type="text" name="user"><br>
Password: <input type="password" name="password"><br>
Remember Me 
<input type="checkbox" name="cookie">
<input type="submit">
</form>
<a href="try.php">
    <button>Sign up here</button>
</a>

<?php

include "db_connection.php";

$conn = OpenCon();

$query = "select user_name, pass_word, id from `accInfo`;";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //username blabla
    $user = $_POST["user"];
    $pass = $_POST["password"];

    $result = mysqli_query($conn, $query); 
    if (mysqli_num_rows($result) > 0) { 
        // OUTPUT DATA OF EACH ROW 
        while($row = mysqli_fetch_assoc($result)) { 

            if(($row["user_name"] == $user) && ($row["pass_word"] == $pass))
            {
                $id = $row["id"];
                 // Password is correct, so start a new session
                 session_start();
                            
                 // Store data in session variables
                 $_SESSION["loggedin"] = true;
                 $_SESSION["id"] = $id;
                 $_SESSION["username"] = $user;  

                header("location: user.php");
                exit;
            }
        } 

        echo "User not found";
    } else { 
        echo "0 results"; 
    }   
}


CloseCon($conn);
?>

</body>
</html>