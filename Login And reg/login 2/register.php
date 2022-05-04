<?php
include("header.php"); // header
include("db.php"); // Databse connection
if(isset($_SESSION['user_logged'])){
    header("Location: ./index.php");
    exit;
    //Exit if already logged
}
$error=[];
if(isset($_POST['send'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $c_password=$_POST['c_password'];
    if($name !=""){
        if(strlen($name) > 4){
            if(strlen($password) > 6){
                if($password == $c_password){
                    $password=md5($password);
                    $sql="INSERT INTO users (name,email,password,date) VALUES ('".$name."','".$email."','".$password."',".time().")";;
                    if($conn->query($sql)){
                        $success=true;
                    }else{
                        $error[]="Server error, please try again later";
                    }
                }else{
                    $error[]="Password not matched"; 
                }
            }else{
                $error[]="Password too short";
            }
            
        }else{
            $error[]="Invalid name, please type your name"; 
        }
    }else{
        $error[]="Error name, please type your name";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <h3>Register to sample facebook</h3>
                        <?php
                            if(!empty($error)){
                                foreach ($error as $key => $value) {
                                    ?>
                                        <div class="alert alert-danger"><?php echo $value;?></div>
                                    <?php
                                }
                            }
                            if(isset($success)){
                                ?>
                                    <div class="alert alert-success">Register succefull</div>
                                <?php
                            }
                        ?>
                        <div class="form-group">
                            <label>Your name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" required/>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="c_password" class="form-control" id="c_password" required/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit" id="regiser_bt" name="send" > Register </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>