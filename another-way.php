<?php
/***********************
	Nikházy Ákos
	
another-way.php
This is another example for the same template.
Here we fill the tagList in another style using
the array('key' => 'content') style.

This is a more compact way to fill the tag list.
***********************/

require 'require/head.php';

$cache				= new Cache(10);
									 
$template		= new Template('index'); 
$listLineTemplate 	= new Template('listItem'); 
$rawTextTemplate	= new Template('',' {{texthere}} at rendering'); 

$text				= new Text('index');

$list = '';

for($i = 1; $i<=10; $i++)
{
	$listLineTemplate -> tagList['item'] = $text->PrintText('listItemText') . $i;
	$list .= $listLineTemplate->Templating(true,false); 
}
	
$rawTextTemplate -> tagList['texthere'] = $text -> PrintText('complete');

// ****************
//
// This is the another style / form to fill the tagList
//
// ****************
$template -> tagList = array(
	'someText' 			=> $text->PrintText('someText'),
	'content'  			=> 'This is simple text in the code',
	'aList'    			=> $list,
	'otherHTML' 		=> NULL,
	'rawStringExample' 	=> $rawTextTemplate -> Templating()
);


$cache -> cache($template -> Templating());

