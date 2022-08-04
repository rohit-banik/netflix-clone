<?php

require_once("includes/header.php");
require_once("includes/paypalConfig.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");

$detailsMessage = "";
$passwordMessage = "";

if(isset($_POST["saveDetailsButton"])) {
    $account = new Account($conn);

    $firstName = FormSanitizer::sanitizeString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeEmail($_POST["email"]);
    
    if($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)) {
        $detailsMessage = "<div class='alertSuccess'>
                                <i class='fas fa-check-circle'></i>Details Updated Successfully
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();

        $detailsMessage = "<div class='alertError'>
                                <i class='fas fa-exclamation-circle'></i>$errorMessage
                            </div>";

    }
}

if(isset($_POST["savePasswordButton"])) {
    $account = new Account($conn);

    $oldPassword = FormSanitizer::sanitizePassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizePassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizePassword($_POST["newPassword2"]);
    
    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)) {
        $passwordMessage = "<div class='alertSuccess'>
                                <i class='fas fa-check-circle'></i>Password Updated Successfully
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();

        $passwordMessage = "<div class='alertError'>
                                <i class='fas fa-exclamation-circle'></i>$errorMessage
                            </div>";

    }
}
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $token = $_GET['token'];
    $agreement = new \PayPal\Api\Agreement();
  
    try {
      // Execute agreement
      $agreement->execute($token, $apiContext);

      // Update user's account status

    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } 
  else if (isset($_GET['success']) && $_GET['success'] == 'false') {
      echo "user canceled agreement";
  }
  
?>

<div class="settingsContainer column">

    <div class="formSection">

        <form method="POST">

            <h2>User Details</h2>

            <?php
                $user = new User($conn, $userLoggedIn); 

                $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
                $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName();
                $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
                
            ?>

            <input type="text" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>">
            <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $lastName; ?>">
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">

            <input type="submit" name="saveDetailsButton" value="Save">

            <div class="message">
                <?php echo $detailsMessage; ?>
            </div>

        </form>

    </div>

    <div class="formSection">

        <form method="POST">

            <h2>Change Password</h2>

            <input type="password" name="oldPassword" placeholder="Old Password">
            <input type="password" name="newPassword" placeholder="New Password">
            <input type="password" name="newPassword2" placeholder="Confirm New Password">

            <div class="message">
                <?php echo $passwordMessage; ?>
            </div>

            <input type="submit" name="savePasswordButton" value="Update Password">

        </form>

    </div>

    <div class="formSection">
        <h2>Subscription</h2>

        <?php

        if($user->getIsSubscribed()) {
            echo "<h3>You are subscribed! Go to PayPal to cancel</h3>";
        }
        else {
            echo "<a class='subscribe' href='billing.php'>Subscribe to PremierX</a>";
        }

        ?>
    </div>

</div>