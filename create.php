<?php
session_start();
$connection = new mysqli('localhost','root','123456','useraccount');


$id ="";
$name 	= "";
$year	= "";
$class	= "";
$section	="";
$date		="";
$reason		= "";
$actions    ="";
$errormessage ="";

$successmessage="";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
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
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                <?php
                global $x;
                $x=0;
                //check the connection
                if ($connection->connect_error){
                    die("connection failed ".$connection->connect_error);
                }

                //read all the row from database table
                $sql="SELECT * FROM users WHERE  id='$_SESSION[username]'";
                $result= $connection->query($sql);

                if(!$result){
                    die("invalid query".$connection->error);
                }
                //read data of each row
                while($row=$result->fetch_assoc()){
                    $x=$x+1;
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
                    <td>$row[status]</td>
                </tr> 
    

                    ";
                }
                ?>


            </tbody>
        </table>
    
        
    </div>
    <?php
    if($x<1)
    {
        ?>

        <div class="container my-5">
            <h2>New absentee form</h2>
            <?php
            if(!empty($errormessage)){
                echo "

                <strong>$errormessage</strong>

                ";

            }

            ?>

                <form method="post">

                    <div class="row mb-3">
                            <label for="id"><b>Id :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <a class="form-control"  type="text" name="id" value="<?php echo $_SESSION["username"]; ?>" required><?php echo $_SESSION["username"]; ?></a>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label ><b>Name :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <input class="form-control"  type="text" name="name" value="<?php echo $name; ?>"required>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label ><b>Year :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <input class="form-control"  type="int" name="year" value="<?php echo $year; ?>"required>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label ><b>Class :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <input class="form-control" type="text" name="class" value="<?php echo $class; ?>" required>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label ><b>Section :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <input class="form-control" type="text" name="section" value="<?php echo $section; ?>" required>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label ><b>Date :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <input class="form-control"  type="date" name="date" value="<?php echo $date; ?>" required>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label ><b>Reason :</b></label>
                            <div class="col-sm-3 col-form-label">
                                <input class="form-control"  type="text" name="reason" value="<?php echo $reason; ?>" required>
                            </div>
                    </div>
                    <?php
                    if(!empty($successmessage)){
                        echo "
                        $successmessage

                        ";
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="offset-sm-3 col-sm-3 d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                        <div class="offset-sm-3 col-sm-3 d-grid">
                            <a class="btn btn-outline-danger" href="/project2/student-logout.php" role="button">logout</a>
                        </div>
                    </div>

                </form>
        <?php 
        } 
        ?>

    </div>
</body>
</html>
<?php


if($x<1){
    if ($_SERVER['REQUEST_METHOD']=='POST'){

        $name 	= $_POST['name'];
        $year	= $_POST['year'];
        $class	= $_POST['class'];
        $section	=$_POST['section'];
        $date		=$_POST['date'];
        $reason		= $_POST['reason'];
        do
        {
            if( empty($name)|| empty($year) || empty($class) || empty($section) || empty($date) || empty($reason)){
                $errormessage = "All fields are required";
                break;
            }
        // add new client
        $sql="INSERT INTO users(id,name,year,class,section,date,reason,actions,status) 
        VALUES('$_SESSION[username]','$name','$year','$class','$section','$date','$reason','','')";
        $result=$connection->query($sql);
    
        if (!$result){
            $errormessage="inavalid query :".$coonection->error;
            break;
        }
        
    
    
    
        $id = "";
        $name 	= "";
        $year	= "";
        $class	= "";
        $section	="";
        $date		="";
        $reason		= "";
        $actions    ="";
        $errormessage ="";
    
        $successmessage="submited successfully";
    
        header("location:/project2/create.php");
        exit;
            
        }while(false);
    
    
    }
    }
else{
    echo "Already submitted";
}


?>
