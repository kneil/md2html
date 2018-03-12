<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../util/Md2HtmlCommand.php';
require __DIR__ . '/../util/functions.php';

use LinkMaker\Md2HtmlCommand;
  
use PHPUnit\Framework\TestCase;

class Md2HtmlTest extends TestCase {

        public function test_warning_for_no_content() {
		$command = new LinkMaker\Md2HtmlCommand;
		$this->expectOutputString("Warning:  No content was detected.  Output is empty.\n") ;
		$command->execute('/', '/tmp/output.html');
        }

	public function test_success(){
		$command = new LinkMaker\Md2HtmlCommand;
		$this->expectOutputString("Your markdown file has successfully been converted to html.\n");
		$command->execute(__DIR__ .'/../fixutures/test.md', '/dev/null');

	}
	public function test_file_output_error(){
		$command = new LinkMaker\Md2HtmlCommand;
		$this->expectOutputString("An error occurred: file_put_contents(/): failed to open stream: Is a directory\n");
		$command->execute(__DIR__ .'/../fixutures/test.md', '/');
	}
}
