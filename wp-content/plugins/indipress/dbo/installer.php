<?php
	global $wpdb;
	
	/* 
		* Add your own tables, prevent table collapse adding index  
		* Check if table exists before create new one
	*/
	
	$sql = "CREATE TABLE IF NOT EXISTS `_indipress` ( `id` int(11) NOT NULL AUTO_INCREMENT, `category` varchar(200) NOT NULL, `name` varchar(200) NOT NULL, `description` text NOT NULL, `attachment` text NOT NULL, `slug` varchar(200) NOT NULL, `type` varchar(200) NOT NULL, `parent` int(5) NOT NULL, `featured` int(2) NOT NULL, `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), KEY `idx_catype` (`category`,`type`) USING BTREE, KEY `idx_type` (`type`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
				
	$wpdb->query($sql);
