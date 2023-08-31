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

		$otherArgs = array();

		for($i = 1; $i < $nargs; $i++)
		{

			$otherArgs[] = func_get_arg($i);

		}

		return ($nargs == 1) ? $this->textFile[$id] : sprintf($this->textFile[$id],...$otherArgs);
		
	}

}
?>
