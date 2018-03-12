<?php

namespace LinkMaker;

use League\CommonMark\CommonMarkConverter;

/**
 * class that handles conversion from Markdown to html
 */
class Md2HtmlCommand
{
	/**
	 * @param string $inputfile
	 * @param string $outputfile
	 */
	function execute($inputfile, $outputfile){

		$errors = false;
	 	// main command functionality
	  $converter = new CommonMarkConverter();
	  \setupErrorHandler();

	  $html="";
	  try {
	      $html = $converter->convertToHtml(file_get_contents($inputfile));
	  }
	  catch ( \Exception $e ) {
				$errors = true;
	      return \outputError($e);
	  }

	  try {
	      file_put_contents($outputfile, $html);
	  }
	  catch ( \Exception $e ) {
				$errors=true;
	      return \outputError($e);
	  }
	  if ( $html == "" && $outputfile != "php://stdout"){
	    $this->warningNoContent();
	  }
		else {
			if ( $outputfile != "php://stdout" && $errors === false ){
				$this->success();
			}
		}
	  restore_error_handler();

	}

	protected function warningNoContent(){
		echo "Warning:  No content was detected.  Output is empty." . PHP_EOL;
	}

	protected function success(){
		echo "Your markdown file has successfully been converted to html." . PHP_EOL;
	}

}
