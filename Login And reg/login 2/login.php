<?php

include("header.php");
include("db.php");
$error=[];
if(isset($_SESSION['user_logged'])){
    header("Location: ./index.php");
    exit;
    //Exit if already logged
}
if(isset($_POST['send'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);
    $sql="SELECT * FROM users WHERE email='".$email."' AND password='".$password."'";
    if($user_data=$conn->query($sql)){
        if($user_data->num_rows > 0){
            $_SESSION['user_logged']=true;
            header("Location: ./");
            exit;
            //success loggin
        }else{
            $error[]="Something wrong, please try again";
        }
    }else{
        $error[]="Something wrong, please try again";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <h3>Login to sample facebook</h3>
                        <?php
                            if(!empty($error)){
                                foreach ($error as $key => $value) {
                                    ?>
                                        <div class="alert alert-danger"><?php echo $value;?></div>
                                    <?php
                                }
                            }
                            ?>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" required/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="login_bt" name="send" >Login</button>
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