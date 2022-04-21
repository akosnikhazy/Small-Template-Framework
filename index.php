<?php
/***********************
	Nikházy Ákos
index.php
The idea is keeping PHP clean from HTML and text.
This small framework does just that. It is pretty
good for small sites.
***********************/

require 'require/head.php';


// ****************
// ini cache
//
// Caching for 10 seconds. If there is a cache that is younger than
// 10 seconds this is the last line that runs in this script.
// You can test this by changing the loop to 100, render the page then 
// turn it back to 10 and try rendering it again you will see the 100 
// lines in 10 seconds window. Also when you change your code you should 
// delete cache files if you work with long Caching times.
// 
// If you want to calculate POSTs, GETs or other dynamic stuff you better
// do it before the Cache class. Also based on you dynamic content you 
// can do a Cache(0) to re-cache the content at that point. 
// ****************

$cache				= new Cache(10); // keep cahe for X seconds
									 
// $cache = new Cache(0); this effectively turns off caching for this page

// ****************
// ini template class
// 
// Template('the name of template file')
// in the template file you find {{something}}. you can replace 
// {{something}} with value by using the tagList[] property
// $template -> tagList['something'] = value property
// ****************
$template			= new Template('index'); 	// this will template the index.html file in the templates folder
$listLineTemplate 	= new Template('listItem'); // this will template the listItem.html file in the templates folder
$rawTextTemplate	= new Template(NULL,' {{texthere}} at rendering'); // This will template that string. The file must be NULL
// ****************
// ini text class
// 
// Text('the name of the text file')
// $text->PrintText('textID') method
// returns the text
// ****************
$text				= new Text('index');

// ****************
// Calculating stuff before using the main template. 
// this is where you put the content together for 
// the template
// ****************

$list = '';

for($i = 1; $i<=10; $i++)
{
	
	// you can use smaller templates. This one keeps a simple <li>{{listItemText}}</li> HTML line
	// also here we use the Text class, that loads text from a .json file by id, instead putting text
	// in PHP code.
	$listLineTemplate -> tagList['item'] = $text->PrintText('listItemText') . $i;
	
	// ****************
	// We collect the list items as a string in a variable.
	// This line returns the templated HTML string (first paramater is true), but do not work on
	// one lineing it (second parameter is false) as at the end it will be one lined anyway.
	// ****************
	$list .= $listLineTemplate->Templating(true,false); 
	
}
	
	
// ****************
// Populate the template here
// Examples:
// ****************

$template -> tagList['someText'] = $text->PrintText('someText');

$template -> tagList['content']  = 'This is the content. You should use the Text.class to put text in these parts, 
									but for the example I write this here. Also this only makes sense if you see
									it in the PHP code in index.php'; 
									
$template -> tagList['aList'] = $list;

$template -> tagList['otherHTML'] = NULL; // this will replace the {{otherHTML}} tag to the otherHTML file's content

// we templating string same way as files
$rawTextTemplate -> tagList['texthere'] = $text -> PrintText('complate');
$template -> tagList['rawStringExample'] = $rawTextTemplate -> Templating();

// ****************
// Show filled template for user and putting it in a cache
// we never reach this point if cache already exists.

// here we use the basic parameters (both true) so we return the templated HTML string in one line.
// then cache it and print it with exit() (happens in the Cache class.
// ****************
$cache -> cache($template -> Templating());

// ****************
// check out the index_no_comment.php file to see how little code does
// how much, to present content to the user.
// ****************
