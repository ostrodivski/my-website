<?php
    include("log.php") ;
    if (!function_exists('str_contains')) {
        function str_contains(string $haystack, string $needle): bool
        {
            return '' === $needle || false !== strpos($haystack, $needle) ;
        }
    }
    
    function you_are_a_bot()
    {
            echo "<img src=\"../images/0/sweetie_bot.jpg\" alt=\"Sweetie Bot\" width=\"577\" height=\"433\" />" ;
            exit(1) ;
    }


    $field_error = "" ;

    if(isset($_POST["user_pseudo"]) && isset($_POST["user_comment"]) && isset($_POST["pagename"]) && !empty($_POST["pagename"]))    # si les variables n'existent pas, ou si le nom de la page n'est pas renseigné, l'utilisateur a contourné le formulaire
    {
        if(!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"]))     # si le captcha n'est pas renseigné, peut-être a-t-on affaire à un bot ?
        {
            you_are_a_bot() ;
        }
        
        $recaptcha_secret = "6LeVLfoeAAAAAEvuBfCjwY2a_C4aSwETJs9jDO52" ;
        $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST["g-recaptcha-response"]) ;
        $response = json_decode($verify_response) ;
        if($response->success)      # si le captcha est faux, peut-être a-t-on affaire à un bot ?
        {
            $pseudo = htmlspecialchars($_POST["user_pseudo"]) ;
            $comment = htmlspecialchars($_POST["user_comment"]) ;
            $pagename = htmlspecialchars($_POST["pagename"]) ;
            
            if(str_contains($pagename, ".") || str_contains($pagename, "/"))    # tentative de directory traversal
            {
                echo "Bien essayé... lâche ce script à présent." ;
                exit(1) ;
            }
            
            if(strlen($pseudo) <= 40 && strlen($comment) <= 3000 && !empty($pseudo) && !empty($comment))
            {
                $comment_page = "../comments/" . $pagename . ".php" ;
                $comments = fopen($comment_page, a) or die("Unable to open file") ;
                setlocale(LC_TIME, "fr_FR");
                date_default_timezone_set("Europe/Paris");
                $date = date("j F Y à G:i") ;
                
                if (md5($pseudo)=="cf42f53e961f2108ca01a51b4867736a")
                {
                    $pseudo="<img src=\"favicon.ico\" class=\"comment_icon\"><b>Vanessa</b>" ;
                }
                
                fwrite($comments, "<div class=\"comment_block\">
                    <p class=\"date\">" . $date . "</p>
                    <p class=\"pseudo\">" . $pseudo . " a écrit :</p>
                    <p class=\"comment\">" . $comment . "</p>\n</div>\n") ;
                fclose($comments) ;
                chmod($comment_page, 0644) ;
            } else {
                $field_error = "&field_error=true" ;
            }
        } else {
            you_are_a_bot() ;

        }
    } else {
        echo "Laisse ce script tranquille." ;
        exit(1) ;
    }

    header("Location: ../" . $pagename . ".php?" . $field_error . "#comment_section") ;
    exit(0) ;

?>