<?php
/***********************
	Nikházy Ákos

index_no_comment.php

The idea is keeping PHP clean from HTML and text.
***********************/

require 'require/head.php';


$cache				= new Cache(10);
									
$template			= new Template('index');
$listLineTemplate 	= new Template('listItem');

$text				= new Text('index');

$list = '';

for($i = 1; $i<=10; $i++)
{
	
	$listLineTemplate -> tagList['item'] = $text->PrintText('listItemText') . $i;
	$list .= $listLineTemplate -> Templating(true,false);
	
}
		
$template -> tagList['someText'] = $text->PrintText('someText');
$template -> tagList['content']  = 'This is the content. You should use the Text.class to put text in these parts, 
									but for the example I write this here. Also this only makes sense if you see
									it in the PHP code in index.php';
								
$template -> tagList['aList'] = $list;

$template -> tagList['otherHTML'] = NULL;

$cache -> cache($template -> Templating());
