<?php

require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($conn);

if(isset($_POST["submitRegister"])){
    
    $firstName = FormSanitizer::sanitizeString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeUserName($_POST["username"]);
    $email = FormSanitizer::sanitizeEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeEmail($_POST["email2"]);
    $password = FormSanitizer::sanitizePassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizePassword($_POST["password2"]);

    $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
    <title>Register to PremierX</title>

    <link rel="stylesheet" href="./assets/style/style.css">

</head>

<body>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="./assets/images/logo.png" title="PremierX" alt="PremierX">
                <h3>Sign Up</h3>
                <span>to continue to PremierX</span>

            </div>

            <form method="POST">

                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First name" autocomplete="off" value="<?php getInputValue("firstName"); ?>" required>
                
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last name" autocomplete="off" value="<?php getInputValue("lastName"); ?>" required>
                
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php getInputValue("username"); ?>" required>
                
                <?php echo $account->getError(Constants::$emailDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" autocomplete="off" value="<?php getInputValue("email"); ?>" required>
                
                <input type="email" name="email2" placeholder="Confirm Email" autocomplete="off" value="<?php getInputValue("email2"); ?>" required>
                
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <input type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required>
                <input type="submit" name="submitRegister" value="SUBMIT">



            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

        </div>

    </div>


</body>

</html>