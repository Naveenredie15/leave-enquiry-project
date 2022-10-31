<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>
<body>
<h1 class="my-5">Hi, <b><?php echo $_SESSION["username"] ?></b>. Welcome to our site.</h1>
    <div class="container my-5">
        <h2>List of students</h2>
        <table class="table">
            <thead>
            <tr>
                <td>sno</td>
                <th>Id</th>
                <th>name</th>
                <th>year</th>
                <th>class</th>
                <th>section</th>
                <th>date</th>
                <th>reason</th>
                <th>actions</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $servername='localhost';
                $username='root';
                $password='123456';
                $database='useraccount';
                //create connection
                $connection=new mysqli($servername,$username,$password,$database);
                //check the connection
                if ($connection->connect_error){
                    die("connection failed ".$connection->connect_error);
                }

                //read all the row from database table
                $sql="SELECT * FROM users";
                $result= $connection->query($sql);

                if(!$result){
                    die("invalid query".$connection->error);
                }
                //read data of each row
                while($row=$result->fetch_assoc()){
                    echo "

                <tr>
                    <td>$row[sno]</td>
                    <td> $row[id]</td>
                    <td>$row[name]</td>
                    <td> $row[year]</td>
                    <td> $row[class]</td>
                    <td> $row[section]</td>
                    <td>$row[date]</td>
                    <td> $row[reason]</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='/project2/approve.php? sno=$row[sno]'>APROVE</a>
                    <a class='btn btn-danger btn-sm' href='/project2/php/delete.php?sno=$row[sno]'>delete</a>
                    </td>
                    <td>$row[status]</td>
                </tr> 
    

                    ";
                }
                ?>


            </tbody>
        </table>
    <p>
        <a href="reset-password-faculty.php" class="btn btn-warning">Reset Your Password</a>
        <a href="/project/faculty-logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    
        
    </div>
    
</body>
</html>