window.onload = function() { var mails = document.querySelectorAll(".mail,.small_mail") ;
for (mail of mails) {
    mail.setAttribute("onclick", "window.open(\"images/mails/" + mail.getAttribute("id") + ".png\")") ;
    mail.setAttribute("style", "cursor: pointer;") ;
} };
