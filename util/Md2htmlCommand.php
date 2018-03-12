<?php

namespace LinkMaker;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


use League\CommonMark\CommonMarkConverter;
use Psr\Log\LoggerInterface;
use LinkMaker\File;

/**
 * class that handles conversion from Markdown to html
 */
class Md2HtmlCommand
{

	protected $fileManager;

	/*
	 * @param string $inputfile
	 * @param string $outputfile
	 */
	function execute($inputfile, $outputfile, $fileManager="LinkMaker\File"){

	  // we'd need additional logic to use S3 etc but the methods would 
	  // still be getFileContents and putFileContents;


	$log = new Logger('logger');
	$log->pushHandler(new StreamHandler(__DIR__.'/../logs/events.log', Logger::DEBUG));
	$log->addInfo('Starting the app.');

	  $this->fileManager = new $fileManager();

		$errors = false;
	 	// main command functionality
	  $converter = new CommonMarkConverter();
	  \setupErrorHandler();

	  $html="";
	  try {
	      $html = $converter->convertToHtml($this->fileManager->getFileContents($inputfile));
	  }
	  catch ( \Exception $e ) {
				$errors = true;
	      return \outputError($e);
	  }

	  try {
	      $this->fileManager->putFileContents($outputfile, $html);
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
