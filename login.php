<?php

require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($conn);

if(isset($_POST["submitLogin"])){
    $username = FormSanitizer::sanitizeUserName($_POST["username"]);
    $password = FormSanitizer::sanitizePassword($_POST["password"]);
    
    $success = $account->login($username, $password);

    if($success) {
        $_SESSION["userLoggedIn"] = $username;
        header('Location: index.php');
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login to PremierX</title>

    <link rel="stylesheet" href="./assets/style/style.css">

</head>

<body>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="./assets/images/logo.png" title="PremierX" alt="PremierX">
                <h3>Sign In</h3>
                <span>to continue to PremierX</span>

            </div>

            <form method="POST" autocomplete="off">

                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php getInputValue("username"); ?>" required>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <input type="submit" name="submitLogin" value="SIGN IN">



            </form>

            <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>

        </div>

    </div>


</body>

</html>