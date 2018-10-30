<?php 

 $db=new PDO("mysql:host=myeusql.dur.ac.uk;dbname=Csrtk88_sunnyhotel", "srtk88", "roma93n",
                  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
						       PDO::ATTR_EMULATE_PREPARES => false));	
				   
 //$db=new PDO("mysql:host=localhost;dbname=hoteldb", "root", "",
                   //array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
						     //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
						     //PDO::ATTR_EMULATE_PREPARES => false));				   
				   
?>