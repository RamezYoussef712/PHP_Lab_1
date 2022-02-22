<?php
    if(file_exists("log.txt")){
        $imported_content = file("log.txt");

        foreach($imported_content as $line){
           $line = explode(",", $line);
           echo "- Visit Date: ".$line[0]."<br/>";
           echo "- IP Address: ".$line[1]."<br/>";
           echo "- Name: ".$line[2]."<br/>";
           echo "- E-mail: ".$line[3]."<br/>";
           echo "- Visits count: ".$line[4]."<br/>";
           echo "*******************************<br/>";
        }

    }
?>