<!DOCTYPE html>
    <body>
    <?php

        require_once("connection.php");

        $a = " ";
        $b = " ";
        $c = " ";
        $flag = "add";
        $theirhobbies = array();

            
        if(isset($_POST["ID"])){
            $id = $_POST['ID'];
            $selecthobbyQuery = "select * from hobbies where empID = $id";
            $hobbychoice = mysqli_query($conn, $selecthobbyQuery);
        
            while ($hobbyrow = mysqli_fetch_array($hobbychoice)){
                array_push($theirhobbies, $hobbyrow['hobby']);
            }
            
            // Below lines are for checking the elements of an array
            //print_r($theirhobbies); 
            $key = in_array('running', $theirhobbies);
            //echo $key;

            $r = mysqli_query($conn, "SELECT * FROM data WHERE ID = '".$id."'");
            while ($row = mysqli_fetch_array($r)) {
                $a =  $row['Forename'];
                $b = $row['Surname'];
                $c = $row['email'];
                $flag = "edit";

            }
        }

        if (isset($_POST["edit"])){
            $Fname = $_POST["Firstname"];
            $Sname = $_POST["Lastname"];
            $email = $_POST["email"];
            $id = $_POST['ID'];
            $hobbies = $_POST["hobbies"];
            
            

        

            if ($Fname == "" or $Sname == "" or $email == "") {
                $message = "Sorry all boxes have to be filled";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } 
            else {
                $selectIDQuery = "SELECT * FROM data WHERE ID = $id";
                $selectIDR = mysqli_query($conn, $selectIDQuery);


                while ($row = mysqli_fetch_array($selectIDR)){
                    $rowId = $row["ID"];
                    $deletesql = "delete from hobbies where empID = $rowId";
                    $deletequery =  mysqli_query($conn, $deletesql);
                    if (isset($_POST["hobbies"])) {
                        $num = count($hobbies);
                        for($i=0; $i < $num; $i++) {
                            $upquery = "INSERT INTO hobbies (name, empID, hobby) VALUES ('".$Fname."', '".$rowId."','".$hobbies[$i]."')";
                            $sqlquery = mysqli_query($conn, $upquery);      
                            

                    }
                }
            }
            header("Location: dynamic_table.php");
        }
    }
        if (isset($_POST["add"])){
            $Fname = $_POST["Firstname"];
            $Sname = $_POST["Lastname"];
            $email = $_POST["email"];

            $hobbies = $_POST["hobbies"];
            
            if ($Fname == " " or $Sname == " " or $email == " "){
                $message = "Sorry all boxes have to be filled";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $query = "INSERT INTO data (Forename, Surname, email) VALUES ('".$Fname."', '".$Sname."','".$email."')";
                $result = mysqli_query($conn, $query);;
                $selectQuery = " SELECT * FROM data ORDER BY ID DESC LIMIT 1";
                $selectResult = mysqli_query($conn, $selectQuery);
                while ($row = mysqli_fetch_array($selectResult)) {
                    $foreignId = $row["ID"];
                    if (isset($_POST["hobbies"])) {
                        //echo "Test successful ";
                        $numofhobbies = count($hobbies);
                        for($i=0; $i < $numofhobbies; $i++) {
                            $upquery = "INSERT INTO hobbies (name, empID, hobby) VALUES ('".$Fname."', '".$foreignId."','".$hobbies[$i]."')";
                            $sqlquery = mysqli_query($conn, $upquery);                         
                        }
                    }
                }

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

            <select multiple="multiple" name="hobbies[]">
                <option value="swimming" <?php if (in_array("swimming", $theirhobbies)){ echo "selected" ; }?>> Swimming</option>
                <option value="running" <?php if (in_array("running", $theirhobbies)){ echo "selected" ; }?>> Running</option>
                <option value="sailing" <?php if (in_array("sailing", $theirhobbies)){ echo "selected" ; }?>> Sailing</option>
                <option value="baseball"<?php if (in_array("baseball", $theirhobbies)){ echo "selected" ; }?>> Baseball</option>
                <option value="pottery"<?php if (in_array("pottery", $theirhobbies)){ echo "selected" ; }?>> Pottery</option>
            </select>

            <input type = "submit" name="<?php echo $flag ?>" value = "submit" /><br>
        </form>
    </body>
</html>

