<?php 

 class ToDoList{

 	// public $name = '';
 	public $filename = 'list.txt';
 	public $items = [];
	// Define a function which will open your default filename, and return an array of items.

	/* This function accepts an array, saves it to file, and returns an array of list items. */ 
	public function openFile(){
		$contentArray = [];

		//If the filesize is greater that zero, use it.
		if (file_exists($this->filename) && filesize($this->filename) > 0) {
			$handle = fopen($this->filename, 'r');
			$contents = trim(fread($handle, filesize($this->filename)));
			$contentArray = explode("\n", $contents);
			$filesize = filesize($this->filename);
			fclose($handle);
		}
		// var_dump($contentArray);
		return $contentArray;
	}
 

	// Define a function which will save your list to file.

	/* This function accepts an array, saves it to file, and returns nothing. */
	public function saveFile($array){

		foreach ($array as $key => $value) {
			$array[$key] = htmlspecialchars(strip_tags($value));
		}

		$handle = fopen($this->filename, 'w');
		// Implode the entire array into one string, with newlines in between each item
		$string = implode("\n", $array);
		//Write that whole sting to file.
		fwrite($handle, $string);
		fclose($handle);
	}
}

?>