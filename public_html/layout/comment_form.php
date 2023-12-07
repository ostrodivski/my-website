<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function recaptchaCallback()
    {
        document.getElementById("button_submit").disabled = false ;
    }
    
    function recaptchaExpiredCallback()
    {
        document.getElementById("button_submit").disabled = true ;
    }
</script>

<hr>

<div id="comment_section">

<p id="comment_section_title">Commentaires</p>
<form action="scripts/happen.php" method="POST">

<fieldset>
    
<?php
if(isset($_GET["field_error"]) && $_GET["field_error"] == "true")
{
    echo "<p class=\"warning\">Erreur dans le remplissage des champs</p>" ;
}
?>

<label for="pseudo">Votre pseudo :</label>
<input type="text" id="pseudo" name="user_pseudo" maxlength=40 placeholder="40 caractères max.">
<br>

<label for="comment_area">Votre message :</label>
<textarea rows="10" cols="40" id="comment_area" name="user_comment" maxlength=3000 placeholder="3000 caractères max."></textarea>
</fieldset>


<div class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpiredCallback" data-sitekey="6LeVLfoeAAAAANToKs7Nj6kZU5W-IxVUmPEXUrhl"></div>

<button id="button_submit" action="submit" disabled>Envoyer</button>

<input type="hidden" name="pagename" value="<?php echo $pagename ; ?>">

</form>

<?php include("comments/" . $pagename . ".php") ?>

</div>