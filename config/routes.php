<?php

return array(
		'news/([a-z]+)/([0-9]+)/([a-z]+)/' => 'news/index/$1/$2/$3/$4', /* Список новостей */
		//'news/([a-z]+)/([0-9]+)/([a-z]+)' => 'news/index/$1/$2/$3', 
		'seen/([a-z]+)' => 'seen/index/$1',
		'currency' => 'currency/index',
		'source' => 'source/index',
		'' => 'site/index'
);

?>