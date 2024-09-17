<?php
session_start();
$email_err = $pwd_err = $email = "";
// database connection
$conn = new mysqli("localhost","root","","test");
if ($conn->connect_error){
    die("DB connection failed ".$conn->connect_error );
}

if (isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);

    if (empty($email)){
        $email_err = "Please Enter the Email";
    }
    elseif(empty($pwd)){
        $pwd_err = "Please Enter the Password";
    }
    else{
        // process the inputs
        $sql = "select * from users where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            // email is correct
            $row = $result->fetch_assoc();
            $db_pwd = $row['password'];
            if (password_verify($pwd, $db_pwd)){
                // password is correct, login successful
                // Use PHP session 
                $_SESSION['name'] = $row['name'];
                if (isset($_POST['remember'])){
                    $rem = $_POST['remember'];
                    // create two cookies
                    setcookie("cookie_email", $email, time() + 60*60*24*30, '/');
                    setcookie("cookie_rem", $rem, time() + 60*60*24*30, '/');
                }
                else{
                    if (isset($_COOKIE['cookie_email'])){
                        setcookie("cookie_email", $email, time() - 60*60*24*30, '/');
                    }
                    if (isset($_COOKIE['cookie_rem'])){
                         setcookie("cookie_rem", $rem, time() - 60*60*24*30, '/');
                    }

                }
                header("location:dashboard.php");

            }
            else{
                $pwd_err = "Incorrect Password";
            }
        }
        else{
            $email_err = "Email is not registered";
        }
    }

}

include "header.php";
?>
<div class="container">
        <h1>Login</h1>
        <?php
        $disp_email = !empty($email) ? $email : (isset($_COOKIE['cookie_email']) ? $_COOKIE['cookie_email'] : "");

        $checked = !empty($rem) ? "checked" : (isset($_COOKIE['cookie_rem']) ? "checked" : "");

        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?=$disp_email?>" placeholder="Enter Email" />
                <div class="text-danger"><?= $email_err?></div>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter Password" />
                <div class="text-danger"><?= $pwd_err?></div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="" name="remember" <?= $checked?>/>
                <label class="form-check-label" for=""> Remember Me </label>
            </div>
            
            <div class="register-btn text-center">
                <button type="submit" class="btn btn-success" name="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>