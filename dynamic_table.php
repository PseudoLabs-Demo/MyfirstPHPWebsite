<html>
    <head>
        <style>
            table, th, tr {
                border: 1px  solid black;
                border-collapse: collapse;
            }
            th, tr{
                padding: 20pt
            }
            th{
                text-align: left 
            }
            tr{
                text-align: center 
            }
        </style>
    </head>
    <body>

        <!--HTML Headings--> 

        <table align = "center", border = 1, width = 1000, height = 150>
            <tr>
                <th>ID</th>
                <th>Forename</th>
                <th>Surname</th>
                <th>email</th>
                <th>delete record</th>
            </tr>


        <!--PHP cell data-->
        <?php

        require_once("connection.php");

        $query = "select * from data";  
        $result = mysqli_query($conn, $query);
            
        $index = 1;

        while ($row = mysqli_fetch_array($result)) {
       ?> 
            <tr>
            <td><?php echo $index?></td>
            <td><?php echo $row['Forename']?></td>
            <td><?php echo $row['Surname']?></td>
            <td><?php echo $row['email']?></td>
            <td>

                <form action="delete_process.php" method="post">
                    <input type="hidden" name="ID" value=<?php echo $row['ID'] ?> />
                    <input type="submit" value="Delete" />
                </form>

                <form action="add_process.php" method="post">
                    <input type="hidden" name="ID" value=<?php echo $row['ID'] ?> />
                    <input type="submit" value="Edit" />
                </form>
            </td>

            </tr>
        <?php
        $index++;       //This is to increment the serial number 
        }
        ?>
        <td colspan = "10">

            <form action = "add_process.php" method="post">
                <input type="submit" name='submit' value = "Add" />

        </table>


        
    </body>
</html>