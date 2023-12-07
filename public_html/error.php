<?php
$status_code = $_GET["code"] ;
$page = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REDIRECT_URL']}";
    if(isset($_SERVER['REDIRECT_QUERY_STRING']) && !empty($_SERVER['REDIRECT_QUERY_STRING']))
    {
        $page .= "?" . $_SERVER['REDIRECT_QUERY_STRING'];
    }

$status=$_GET["code"] ;

include("scripts/log.php") ;

if($_GET["code"] == "401")
{
    echo "<p style=\"font-size: 64 ;\">CODE 401 : UNAUTHORIZED</p>" ;
    echo "<p><a href=\"https://mywebsite.fr/index.php \">Dégage de là !</a></p>" ;
} else if ($_GET["code"] == "403") {
    echo "<p style=\"font-size: 64 ;\">CODE 403 : FORBIDDEN</p>" ;
    echo "<img src=\"https://mywebsite.fr/images/0/principal_of_the_thing.jpg\" alt=\"principal of the thing\" width=\"256\" height=\"512\">" ;
    echo "<p> No entering restricted area ! 30 seconds of detention !</p>" ;
    echo "<p id=\"timer\"></p>" ;
    echo "
        <script>
        var sec = 30;
        function tick()
        {
            document.getElementById('timer').innerText = sec ;
         
            if(sec == 0)
            {
                document.getElementById('timer').innerText = 'Okay, you can go now : ' ;
                var back = document.createElement('a') ;
                document.getElementById('timer').appendChild(back) ;
                back.innerText = 'main page' ;
                back.setAttribute('href', 'https://mywebsite.fr/index.php') ;
                window.clearInterval(timer);
            }
 
            sec--;
        }
        var timer = window.setInterval(tick, 1000);
    </script>" ;
    
} else if ($_GET["code"] == "404") {
    echo "<img src=\"https://mywebsite.fr/images/0/404.gif\" alt=\"erreur 404\" width=\"720\" height=\"257\">" ;
    echo "<p>Cliquez <a href=\"https://mywebsite.fr/index.php \">ici</a> pour revenir sur la page principale.</p>" ;
} else if ($_GET["code"] == "500") {
    echo "<img src=\"https://mywebsite.fr/images/0/error_500.jpg\" alt=\"erreur 500\" width=\"600\" height=\"461\">" ;
}
?>
