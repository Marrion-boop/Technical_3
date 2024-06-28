<html>
 <head>
 </head>
 <body>
    <?php

        session_start();
        
        // Check if the user is logged in, if not then redirect him to login page
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: front.php");
            exit;
        }  
        
        include "db_connection.php";

        $conn = OpenCon();

        $query = "Select id, first_name, middle_name, last_name, user_name, pass_word, contact_number, birth_date, email FROM `accInfo`;"; 
        // FETCHING DATA FROM DATABASE 
        $result = mysqli_query($conn, $query); 
        
        if (mysqli_num_rows($result) > 0) { 
            // OUTPUT DATA OF EACH ROW 
            while($row = mysqli_fetch_assoc($result)){
                if($row["id"] == $_SESSION["id"])
                {
                    $first_name = $row["first_name"];
                    $middle_name = $row["middle_name"];
                    $last_name = $row["last_name"];
                    $birth_date = $row["birth_date"];
                    $email = $row["email"];
                    $contact_number = $row["contact_number"];
                    $dcurr_pass = $row["pass_word"];
    
                    echo "<b> Welcome </b> $first_name $middle_name $last_name <br>";
                    echo "Birthday: $birth_date <br>";
                    echo "<b>Contact Details</b> <br>";
                    echo "Email: $email <br>";
                    echo "Contact: $contact_number <br>";
                }   
            }
            
        } else { 
            echo "0 results"; 
        } 



    ?>

    <hr>
    Reset Password <br>

    <form method="POST">
    Enter Current Password: <input type="password" name="cur_pass"><br>
    Enter New Password: <input type="password" name="new_pass"><br>
    Re-Enter New Password: <input type="password" name="cnew_pass"><br>
    <input type="submit" value = "Reset Password">
    </form> 

    <?php




$cpassword_err =  $curpassword_err = $new_pass = "";


   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_pass = $_POST["new_pass"];
    if(!(($_POST["cnew_pass"]) == ($_POST["new_pass"])))
    {
        echo "New password and Re-Enter new password should be the same.<br>";
        $cpassword_err = "Password and confirm password are not the same";
        
    }
    if(!(($_POST["cur_pass"]) == $dcurr_pass))
    {
        echo "Current password is not the same with the old password<br>";
        $curpassword_err = "Password and confirm password are not the same";
        
    }

    if(empty($cpassword_err) && empty($curpassword_err))
    {
        $temp_id = $_SESSION["id"];
        
        $query = "update accInfo SET pass_word = '$new_pass' WHERE id=$temp_id;"; 
        // FETCHING DATA FROM DATABASE 
        $result = mysqli_query($conn, $query); 
    }
}
    CloseCon($conn);
    ?>

     <a href="logout.php">
    <button>Log out</button>
    </a>
 </body>
</html>