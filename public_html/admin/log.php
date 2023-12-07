<?php
    function get_entries($raw_feed)
    {
        $raw_entries = explode("\n", $raw_feed) ;
        $entries = [] ;
        foreach($raw_entries as $raw_entry)
        {
            array_push($entries, json_decode($raw_entry, true)) ;
        }
        array_pop($entries) ;
        return $entries ;
    }
    
    function get_detailed_entries($raw_feed)
    {
        $log = "" ;
        $tmp_day = -1 ;
        $day = 0 ;
        $entries = get_entries($raw_feed) ;
        foreach($entries as $entry)
        {
            $day = floor((double)$entry["date"]/86400)*86400 ;
            if($day != $tmp_day)
            {
                $log .= "\n****** " . date("m/d/Y", $entry["date"]) . " ******\n\n" ;
                $tmp_day = $day ;
            }
            
            if($entry["status"][0] == "2") {
                $entry_type = "ok" ;
            } else if($entry["status"][0] == "3") {
                $entry_type = "redirect" ;
            } else {
                $entry_type = "error" ;
            }
            
            $log .= date("H:i:s", $entry["date"]) . "\n" .
                "ip : " . $entry["ip"] . "\n" .
                "page : " . $entry["page"] . "\n" .
                "referer : " . $entry["referer"] . "\n" .
                "user agent : " . $entry["useragent"] . "\n" .
                "remote host : " . $entry["remotehost"] . "\n" .
                "data : " . $entry["data"] . "\n" .
                "status code : <span class=\"" . $entry_type . "\">". $entry["status"] . "</span>\n\n";
        }
        return $log ;
    }

    function get_global_entries($raw_feed)
    {
        $log="" ;
        $tmp_day = -1 ;
        $day = 0 ;
        $entries = get_entries($raw_feed) ;
        foreach($entries as $entry)
        {
            $day = floor((double)$entry["date"]/86400)*86400 ;
            if($day != $tmp_day)
            {
                $log .= "\n****** " . date("m/d/Y", $entry["date"]) . " ******\n\n" ;
                $tmp_day = $day ;
            }                
            
            if($entry["status"][0] == "2") {
                $entry_type = "ok" ;
            } else if($entry["status"][0] == "3") {
                $entry_type = "redirect" ;
            } else {
                $entry_type = "error" ;
            }
                
            $log .= "<span class=\"" . $entry_type . "\">". "* " . date("H:i:s", $entry["date"]) . " : " . $entry["ip"] . " reached " . $entry["page"] . "</span>\n" ;
        }
        return $log ;
    }

    function print_global_log()
    {
        $raw_feed = file_get_contents("logs/raw_traffic") ;
        echo nl2br(get_global_entries($raw_feed)) ;
        return 0 ;
    }
    
    function print_detailed_log()
    {       
        $raw_feed = file_get_contents("logs/raw_traffic") ;
        echo nl2br(get_detailed_entries($raw_feed)) ;
        return 0 ;
    }
    
    if($_GET["display"] == "detailed")
    {
        print_detailed_log() ;
    } else {
        print_global_log() ;
    }
?>

<style>
.error {
    color: red;
}

.redirect {
    color: yellow ;
}
</style>