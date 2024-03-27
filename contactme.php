<!DOCTYPE html>
<html lang="en">
    <?php

    $user_email = "";
    $user_subject = "";
    $user_message = "";
    $user_full_name = "";
    $recipient = "";
    $to = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $user_full_name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $user_subject = $_POST['subject'];
        $user_message = $_POST['message'];
        $recipient = $_POST['recipient'];

        if($recipient === "Justin Farley"){
            $to = "j@farley-family.com";
        }
        elseif($recipient === "Red Lobster Studios"){
            $to = "studioredlobster@gmail.com";
        }
        $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $user_message = $user_message . "FROM " . $user_email;

        if(preg_match(".+@.+\.com", $user_email) === 1){
            mail($to, $user_subject, $user_message);
        }
    }
    ?>
    <head>
        <meta charset="utf-8">
        <title>Contact Justin Farley</title>
        <link rel="stylesheet" type="text/css" href="./contactStyle.css">
    </head>
    <body>
        <section id="contact-me-form">
            <form action="./processForm.php" method="POST">
                <h1>Contact Me</h1>
                <div class="inputField">
                    <input type="text" name="name" id="name" placeholder="Full Name..." required minlength="2" maxlength="40" pattern=".+ .+"> 
                </div>

                <div class="inputField">
                    <input type="text" name="email" id="email" placeholder="your@email.com" required pattern=".+@.+\.com">
                </div>
                
                <div class="inputField">
                    <input type="text" name="subject" id="subject" placeholder="Subject..." required minlength="3" max="150">
                </div>

                <div class="inputField">
                    <textarea name="message" id="message" rows="8" cols="50" placeholder="Message..." required></textarea>
                </div>

                <div class="inputField">
                    <label for="recipient">To:</label>
                    <select name="recipient">
                        <option value="justinfarley">Justin Farley</option>
                        <option value="rls">Red Lobster Studios</option>
                    </select>
                </div>

                <input type="submit" value="Send">
            </form>
        </section>
    </body>
</html>