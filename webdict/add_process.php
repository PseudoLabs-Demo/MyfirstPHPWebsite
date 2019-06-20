<!DOCTYPE html>
    <body>
    <?php

        require_once("connection.php");

        $a = " ";
        $b = " ";
        $c = " ";
        $flag = "add";

            
        if(isset($_POST["ID"])){
            $id = $_POST['ID'];
            $r = mysqli_query($conn, "SELECT * FROM data WHERE ID = '".$id."'");
            while ($row = mysqli_fetch_array($r)) {
                $a =  $row['Forename'];
                $b = $row['Surname'];
                $c = $row['email'];
                $flag = "edit";

                // $a = mysqli_query($conn, "SELECT Forename FROM data WHERE ID = $_POST["ID"])";
                // $b = mysqli_query($conn, "SELECT Surname FROM data WHERE ID = $_POST["ID"])";
                // $c = mysqli_query($conn, "SELECT email FROM data WHERE ID = $_POST["ID"])";
            }
        }

        if (isset($_POST["edit"])){
            $Fname = $_POST["Firstname"];
            $Sname = $_POST["Lastname"];
            $email = $_POST["email"];
            $id = $_POST['ID'];
            
            if ($Fname == "" or $Sname == "" or $email == ""){
                $message = "Sorry all boxes have to be filled";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
               $query = "UPDATE data SET Forename = '".$Fname."', Surname = '".$Sname."', email = '".$email."' WHERE ID = '".$id."'";
                $result = mysqli_query($conn, $query);
                header("Location: dynamic_table.php");
            }
        }

        if (isset($_POST["add"])){
            $Fname = $_POST["Firstname"];
            $Sname = $_POST["Lastname"];
            $email = $_POST["email"];


            if ($Fname == " " or $Sname == " " or $email == " "){
                $message = "Sorry all boxes have to be filled";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                echo "This is the ", $Fname;   
                $query = "INSERT INTO data (Forename, Surname, email) VALUES ('".$Fname."', '".$Sname."','".$email."')";
                $result = mysqli_query($conn, $query);
                header("Location: dynamic_table.php");
            }
        }        


    ?>
        <form action="add_process.php" method="post">
        
            Please enter the Firstname:<br>
            <input type ="text" name ="Firstname" value="<?php echo $a ?>" /><br>
            Please enter the Surname:<br>
            <input type ="text" name ="Lastname" value="<?php echo $b ?>"  /><br>
            Please enter the email address:<br>
            <input type = "text" name ="email" value="<?php echo $c ?>" /><br><br>
            <input type = "hidden" name ="ID" value="<?php echo $_POST["ID"] ?>" />
            <input type = "submit" name="<?php echo $flag ?>" value = "submit" /><br>
        </form>
    </body>
</html>

