<?php 
    require './php/PDO.php';//connection to dataBase 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = $_POST['email'];
        $pwd = $_POST['pwd'];

        $stat = $con->prepare('SELECT username , password FROM clients WHERE username = ? LIMIT 1');
        $stat->execute(array($mail));
        if($stat->rowCount()){
            $data = $stat->fetch(2);//fetch all data of this client
            if(password_verify($pwd,$data['password'])){//check password
                $msg = '
                    <div class="alert alert-success text-center">
                        <p class="lead">
                            you are logged in congraz :)
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </p>
                    </div>
                ';         
            }else {
                $msg = '
                    <div class="alert alert-danger text-center">
                        <p class="lead">
                            username or Password does not exist :(
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </p>
                    </div>
                ';         
            }
        }else {
            $msg = '
            <div class="alert alert-danger text-center">
                <p class="lead">
                    client does not register if you want to register click here <a href="./register.php">REGISTER</a> :(
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
            </div>
        ';         
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Login</title>
</head>
<body>
    <div class="container mx-auto">
        <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class='login mx-auto' >
            <h1 class="text-center"> Login </h1>
            <?php if ( isset($msg) && $msg != '') { echo $msg ; }?>
            <div class="form-group">
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control" 
                    placeholder=' Your Username' 
                    required
                    autocomplete = 'off'
                    value = <?php echo (isset($mail))? $mail : ''; ?>
                >
            </div>
            <div class="form-group">
                <input
                    type="password"
                    name="pwd" 
                    id="pwd" 
                    class="form-control" 
                    placeholder=' Your Password' 
                    required 
                    autocomplete = 'new-password' 
                >
            </div>
            <div class="form-group">
                <button type="submit" class='btn btn-primary btn-block'>Login</button>
            </div>
        </form>
    </div>
    <script src="../layout/js/jquery-3.3.1.min.js"></script>
    <script src="../layout/js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script></body>
</html>


