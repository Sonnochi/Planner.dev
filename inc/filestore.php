<?php

class Filestore
{
    protected $filename = '';
    protected $isCSV = false;

    public function __construct($filename)
    {
        $this->filename =$filename;

         if (substr($filename, -3) == 'csv'){
            $this->isCSV = true;
         }
    }

    public function read()
    {
    
        if ($this->isCSV)
        { 
            return $this->readCSV();
        } else{
            return $this->readLines();
        }
    }

    public function write($array)
    {

        if ($this->isCSV){
            return $this->writeCSV($array);
        } else{
            return $this->writeLines($array);
        } 

    }

    /**
     * Returns array of lines in $this->filename
     */
    protected function readLines()
    {
        if (filesize($this->filename) == 0) {
            throw new Exception("File is empty.");  
        }

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

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    protected function writeLines($array)
    {
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

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function readCSV()
    {

    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    function writeCSV($array)
    {

    }
}