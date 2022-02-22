<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        $name = "";
        $email = "";
        $msg = "";
        
        if(isset($_POST["submit"])){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $msg = $_POST["message"];
            $flag = 0;

            if(!empty($name)){        
                if(strlen($name) > 100){
                    echo "The name must be less than 100 characters <br/>";
                    $flag = 1;
                }
                } else{
                    echo "The name field is required* <br/>";
                    $flag = 1;
                }

            if(!empty($email)){
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "Invalid E-mail <br/>";
                    $flag = 1;
                }
            } else{
                echo "The e-mail field is required* <br/>";
                $flag = 1;
            }

            if(!empty($msg)){
                if(strlen($msg) > 250){
                    echo "Your message is too long, it must be less tan 250 characters <br/>";
                    $flag = 1;
                }
            } else {
                echo "The message field is required* <br/>";
                $flag = 1;
            }

            if($flag == 0){
                foreach($_POST as $key=>$value){
                    if($key != "submit")
                    echo "- $key : $value <br/>";
                }

                if(!isset($_SESSION["is_visited"])){
                    $_SESSION["is_visited"] = true;
                } else{
                    $_SESSION["counter"] = isset($_SESSION["counter"]) ? $_SESSION["counter"] + 1 : 1;
    
                    $fp = fopen("log.txt", "a");
                    $line = date("F d Y h:m a").", ".$_SERVER["REMOTE_ADDR"].", ".$name.", ".$email.", ".$_SESSION["counter"].PHP_EOL;
                    fwrite($fp, $line);
                    fclose($fp);
                    die();
                }
            }

            
        }    


        
    ?>


        <h3> Contact Form </h3>
        <div id="after_submit">
            
        </div>
        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php echo $name ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php echo $email ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30" ><?php echo $msg ?></textarea><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
    </body>
</html>