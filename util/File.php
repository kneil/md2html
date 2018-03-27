<?php

namespace LinkMaker;

class File
{
	public function __construct(){
		//
	}

	public function getFileContents($inputfile){
		return file_get_contents($inputfile);
	}

	public function putFileContents($outputfile, $content){
		return file_put_contents($outputfile, $content);
	}

}
