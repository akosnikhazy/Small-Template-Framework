<?php
/***********************
	Nikházy Ákos

Template.class.php

Usage:
$template = new Template('templateName'); // template name is the file name of the html file in the templates folder

$template -> tagList['tag1name'] = 'tag 1 content';
$template -> tagList['tag2name'] = 'tag 2 content';
$template -> tagList['tag3name'] = NULL; // if its NULL it loads a HTML file content itself. In this case: tag3name.html 
					 // it comes handy when you have simple repeating HTML tags you want put in your result.
					 
					 // Be aware: if you use data from database, you can end up with NULL as value. You should
					 // always check for that case if a tag is expected to have real content. You can do this:
					 //  $template -> tagList['content'] = ($data === NULL)? 'no data' : $data;

echo $template -> Templating(); // this returns the finished templated file content
$template -> templateozas(false); // this collects the finished templated content in the finishedTemplate property

Example template file:

templateName.html

<span>{{tag1name}}</span>
<div id="{{tag2name}}"></div>

***********************/

class Template{
	
	private $fileName 				= '';
	private $templateFile			= '';
	private $fromWhat				= Array();
	private $toWhat					= Array();
	
	// you collect content in this like this: $object -> tagList['tagName'] = 'stg';
	public $tagList 				= Array();
	
	// you can customize the folder. For example I had a case where I had XML templates too so I made a templates/XML folder too
	public $templateFolder			= 'templates/html';
		
	// you can customize your tags now its {{tagname}}
	public $tagOpen					= '{{';
	public $tagClose				= '}}';
	
	// you can access the templated content
	public $finishedTemplate		= '';
	

	
	function __construct($_fileName) 
	{
	
		$this -> fileName 		= $_fileName;

		$this -> templateFile	= file_get_contents($this -> templateFolder . '/' . $_fileName . '.html');
		
	}
	
	public function Templating($return = true,$oneLiner = true)
	{
		
		// ****************
		// $return: if false it will only save the templateted HTML in finishedTemplate property
		// 
		// $oneLiner: if false it returns the HTML as is. 
		// ****************
		
		$this -> FromWhatToWhat();
		
		$this -> finishedTemplate = str_replace(
							$this -> fromWhat, 
							$this -> toWhat, 
							$this -> templateFile
							);
												 
		if($return) return ($oneLiner)?$this -> oneLiner($this -> finishedTemplate)
									  :$this -> finishedTemplate;
		
	}
	

	private function FromWhatToWhat()
	{

		$this -> fromWhat	= Array();
		$this -> toWhat		= Array();
			
		foreach($this -> tagList as $tag => $content)
		{
			
			$this -> fromWhat[]	= $this -> tagOpen . $tag . $this -> tagClose;
			$this -> toWhat[] 	= $content;
			
			if($content === NULL) // rare case
				$this -> toWhat[count($this -> toWhat)-1] = file_get_contents($this -> templateFolder . '/' . $tag . '.html');
			
		}
		
	}
	
	private function oneLiner($in)
	{
		return preg_replace('/^\s+|\n|\r|\t|\s+$/m', '', $in);
	}
	
}
?>
