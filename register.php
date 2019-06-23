<?php 
    require './php/PDO.php';//connection to dataBase 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = $_POST['email'];
        $pwd = $_POST['pwd'];
        $re_pwd = $_POST['re_pwd'];
        if($pwd <> $re_pwd){
            $msg = '
                    <div class="alert alert-danger text-center">
                        <p class="lead">
                            password must be equal
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </p>
                    </div>
            ';
        }

        if(empty($msg)){
            $check = $con->prepare('SELECT username FROM clients where username = ?');
            $check->execute(array( $mail));
            if (! $check->rowCount()) {
                $hash = password_hash($pwd,PASSWORD_BCRYPT);
                $stat = $con->prepare('INSERT INTO clients (username, password, date ) values (?,?, now())');
                $stat->execute(array($mail,$hash));
                $msg = '
                    <div class="alert alert-success text-center">
                        <p class="lead">
                            you are registered with successfully congraz :) click here to <a href="./login.php">LOGIN</a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </p>
                    </div>
                ';  
            }else{ 
                $msg = '
                        <div class="alert alert-danger text-center">
                            <p class="lead">
                                username is already exist if you want to login click here <a href="./login.php">LOGIN</a> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </p>
                        </div>
                ';
            }
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
            <h1 class="text-center"> Register </h1>
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
                    value = <?php echo (isset($pwd))? $pwd : ''; ?>
                >
            </div>
            <div class="form-group">
                <input
                    type="password"
                    name="re_pwd" 
                    id="re_pwd" 
                    class="form-control" 
                    placeholder=' repeat Password' 
                    required 
                    autocomplete = 'new-password' 
                    
                >
            </div>
            <div class="form-group">
                <button type="submit" class='btn btn-primary btn-block'>Register</button>
            </div>
        </form>
    </div>
    <script src="../layout/js/jquery-3.3.1.min.js"></script>
    <script src="../layout/js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>


