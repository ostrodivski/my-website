<?php

if($_SERVER['PHP_SELF'] == "/scripts/log.php")
{
    echo("Laisse ce script tranquille.") ;
    exit(0) ;
}

$ipaddress = htmlspecialchars($_SERVER['REMOTE_ADDR']);
if(!isset($page))
{
    $page = "https://" . htmlspecialchars($_SERVER['HTTP_HOST']) . htmlspecialchars($_SERVER['PHP_SELF']) ;
    if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
    {
        $page .= "?" . htmlspecialchars($_SERVER['QUERY_STRING']);
    }
}
$referer="" ;
if(isset($_SERVER['HTTP_REFERER']))
{
    $referer = htmlspecialchars($_SERVER['HTTP_REFERER']);
}
$date = time() ;
$useragent = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
$remotehost = @getHostByAddr($ipaddress);
$data = json_encode(array_map('htmlspecialchars', $_POST)) ;
if(!isset($status))
{
    $status = "200" ;
}
$entry = array("ip"=>$ipaddress, "date"=>$date, "page"=>$page, "referer"=>$referer,
    "useragent"=>$useragent, "remotehost"=>$remotehost, "data"=>$data, "status"=>$status) ;

$raw_log_file = fopen("/home/u610985200/domains/mywebsite.fr/public_html/admin/logs/raw_traffic", "a") ;
if($raw_log_file)
{
    fwrite($raw_log_file, json_encode($entry) . "\n") ;
    fclose($raw_log_file) ;
}

?>
