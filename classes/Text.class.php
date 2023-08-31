<?php
/***********************
	Nikházy Ákos

Text.class.php loading text from .json

Text file looks like this:
{
	"textid1":"text",
	"textid2":"text2,
	"something":"A whole paragraph",
	"formatedText":"This text will be formated you can add as many %s and %d and %e etc as you wish"

}

Usage:
$text = new Text('yourtextfile.json');

$text -> textFolder = 'example-text-folder'

// print a simple text
echo $text -> PrintText('textid2');

// print a formated text
echo $text -> PrintText('formatedText','string',3,3.3);



***********************/

class Text{
	

	public  $textFolder	= 'text';
	
	private $textFile = '';
	
	
	function __construct($_fileName) 
	{
	
		$this->textFile	= json_decode (file_get_contents($this->textFolder . '/' . $_fileName .  '.json'),true);
		
	}
	
	public function getTextArray()
	{
		return $this->textFile;
	}
	
	
	public function PrintText()
	{
		$nargs = func_num_args();
		// no args => that is a real problem
		if($nargs < 1) throw new Exception('Missing args. At least one needed');
		
		$id = func_get_arg(0);

		// no such id? We just tell it to the user
		if(!array_key_exists($id,$this->textFile)) return 'missing text';

		if($nargs > 1)
		{
			$otherArgs = func_get_args();
			array_shift($otherArgs);
			
			return sprintf($this->textFile[$id],...$otherArgs);
		}

		return $this->textFile[$id];
		
	}

	public function GetText()
	{ // "PrintText" was not a good name for it because it does not print text. It gets text.
	  // I put this here so we have a method with proper naming and still keep everything backwards compatible.
	
		return $this -> PrintText(...func_get_args());

	}

}
?>
