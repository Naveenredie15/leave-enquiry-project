<?php
session_start();
$servername ='localhost';
$username='root';
$password ='123456';
$database='useraccount';



$connection = new mysqli($servername,$username,$password,$database);
$sno ="";
$id  ="";
$name 	= "";
$year	= "";
$class	= "";
$section	="";
$date		="";
$reason		= "";
$errormessage ="";

$successmessage="";
if ($_SERVER['REQUEST_METHOD']=='GET')
{
    //get method:: showoo data of user

    if(!isset($_GET["sno"])){
        header("location:/project2/index.php");

    }

    $sno =$_GET["sno"];

    //read the row of the selected student
    $sql="SELECT * FROM users WHERE sno=$sno";
    $result= $connection->query($sql);
    $row =$result->fetch_assoc();

    if(!$row){
        header("location: /project2/index.php");
        exit;
    }
    $id =$row["id"];
    $name 	=$row["name"];
    $year	= $row["year"];
    $class	= $row["class"];
    $section	=$row["section"];
    $date		=$row["date"];
    $reason		=$row["reason"];
    

}
else{
    //post method:update the data
    $id =$_POST["id"];
    do
    {
    // add new client
    $sql="UPDATE users SET status ='approved by  $_SESSION[username]' WHERE id='$id' ";
    $result=$connection->query($sql);

    if (!$result){
        $errormessage="inavalid query :".$coonection->error;
        break;
    }



    $successmessage="submited successfully";

    header("location:/project2/faculty.php");
    exit;
        
    }while(false);


}

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
        <h2>New absentee form</h2>
        <?php
        if(!empty($errormessage)){
            echo "

            <strong>$errormessage</strong>

            ";

        }

        ?>
        <form method="post">
            <input type="hidden" name="sno" value="<?php echo $sno; ?>">
            <div class="row mb-3">
                    <label for="id"><b>Id :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control"  type="text" name="id" value="<?php echo $id; ?>" >
                    </div>
            </div>
            <div class="row mb-3">
                    <label ><b>Name :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control"  type="text" name="name" value="<?php echo $name; ?>">
                    </div>
            </div>
            <div class="row mb-3">
                    <label ><b>Year :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control"  type="int" name="year" value="<?php echo $year; ?>">
                    </div>
            </div>
            <div class="row mb-3">
                    <label ><b>Class :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control" type="text" name="class" value="<?php echo $class; ?>" >
                    </div>
            </div>
            <div class="row mb-3">
                    <label ><b>Section :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control" type="text" name="section" value="<?php echo $section; ?>" >
                    </div>
            </div>
            <div class="row mb-3">
                    <label ><b>Date :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control"  type="date" name="date" value="<?php echo $date; ?>" >
                    </div>
            </div>
            <div class="row mb-3">
                    <label ><b>Reason :</b></label>
                    <div class="col-sm-3 col-form-label">
					    <input class="form-control"  type="text" name="reason" value="<?php echo $reason; ?>" >
                    </div>
            </div>
            <?php
            if(!empty($successmessage)){
                echo "
                <strong>$successmessage</strong>

                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/project2/index.php" role="button">Cancel</a>
                </div>
            </div>

        </form>

    </div>
    
</body>
</html>