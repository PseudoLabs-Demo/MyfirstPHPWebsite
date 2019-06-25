<!DOCTYPE html>
    <body>
        <?php
        echo "Cake";
        require_once("connection.php"); 
        $id = $_POST["ID"]; 
        $delete = " delete from data where ID = $id ";
        $result = mysqli_query($conn,$delete);
        header('Location: dynamic_table.php');
        ?>1
    </body>
</html>