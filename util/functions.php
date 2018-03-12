<?php

/* Useful utility functions */

function setUpErrorHandler(){
	set_error_handler(
	    create_function(
		     '$severity, $message, $file, $line',
		      'throw new ErrorException($message, $severity, $severity, $file, $line);'
	    )
	);
}

function outputError($e){
	echo "An error occurred: " . $e->getMessage() . PHP_EOL;
	return false;
	//exit (1);
}
