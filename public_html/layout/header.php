<!DOCTYPE html>

<?php header("Content-Security-Policy: default-src 'self'") ; ?>

<style>
:where(body, iframe, pre, img, figure, svg, video, embed, canvas, select, div){
    max-width: 100%;
    overflow: auto;
    word-break: break-word;
}
</style>

<head>
    <meta http-equiv="content-language" content="fr" />
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo $description ; ?>" />
    <meta charset="utf-8" />
    <?php if(!isset($nocard)) { include('twitter_card.php') ; } ?>



    <title><?php echo $title ; ?></title>
	<link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="canonical" href="https://mywebsite.fr/<?php echo $canonical ; ?>" />
	<script type="text/javascript" src="script.js"></script>
</head>

<body>

<nav>
    <ul id="menu">
        <li class="menu_item">Pages
            <ul class="unfolding">
                <li><a href="page1.php">Page1</a></li>
                <li><a href="page2.php">Page2</a></li>
                <li><a href="page3.php">Page3</a></li>
                <li><a href="page4.php">Page4</a></li>
            </ul>
        </li>
        <li class="menu_item"><a href="author.php">Qui suis-je ?</a></li>
    </ul>
</nav>
