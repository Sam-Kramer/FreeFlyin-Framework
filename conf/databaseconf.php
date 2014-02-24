<?php
/*
*	CONF files are PHP to restrict access to the public (YML would be a better idea, but
* people are  generally dumb and don't restrict that file access and would requier caching)
*/

// Tables that can be modified. 
class DatabaseConf {
	public static $tables = 
		array(
							'users' => 
								array('username' => array('text', '%[^A-Za-z0-9 !?.]%', 3, 30), 
									  'password' => array('password', '%[^A-Za-z0-9 !?.]%', 3, 30)),
							'products' => 
								array('title' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 30),
								'price' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 30),
								'image' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 50),
								'description' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 10000),
								'category_id' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 50),
								'status' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 2)), 
							'categories' =>
								array('id' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 30),
									'title' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 30)),
							'archives' => 
								array('product_id' => array('text', '%[^0-9]%', 1, 30),
								'title' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 30),
								'price' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 30),
								'image' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 50),
								'description' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 10000),
								'category_id' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 50),
								'status' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 2),
								'trans_id' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 60)), 
							'transactions' =>
								array('product_id' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 30),
								'first_name' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 50),
								'last_name' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 50),
								'address' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 100),
								'city' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 100),
								'state' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 100),
								'zip' => array('text', '%[^0-9]%', 1, 12),
								'timestamp' => array('text', '%[^A-Za-z0-9 !?.]%', 0, 100),
								'status' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 2),
								'price' => array('text', '%[^A-Za-z0-9 !?.]%', 1, 50)));

}
?>