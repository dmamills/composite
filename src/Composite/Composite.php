<?php
namespace Composite;


class Composite {

	public function __construct($base,$overlay,$outfile,$options = array())
	{
		$this->base = $base;
		$this->overlay = $overlay;
		$this->outfile = $outfile;

		$this->options = $options;
		$this->executed = false;
	}

	/*
		Executes the composite command
	*/
	public function execute()
	{

		if(!file_exists($this->overlay)) {
			throw new \Exception('Overlay image not found.');
		}

		if(!file_exists($this->base)) {
			throw new \Exception('Base image not found.');
		}

		$results = array();
		$command = Composite::prepareCommandString();
		echo 'Executing command: '.$command;
		exec($command,$results);


		$this->executed = true;
		//parse results for errors/success
		return $results;
	}

	public function getOverlayFile()
	{
		if(!file_exists($this->overlay))
		{
			throw new \Exception('Overlay not found.');
		}

		return fopen($this->overlay,'r+');
	}


	/*
		Returns the created image as a file
		if $execute is true it will execute the command first
		if the command has not been executed an exception is thrown
	*/
	public function getOutFile($execute = false)
	{
		if($execute)
		{
			$this->execute();
		}

		if(!$this->executed) throw new \Exception('Composite not executed.');
		$file = fopen($this->outfile,'r+');
		return $file;
	}


	/*
		Creates the composite string for execute
	*/
	private function prepareCommandString()
	{
		//composite -gravity center smile.gif rose: rose-over.png
		$command = 'composite ';

		foreach($this->options as $key => $value)
		{
			if($value != null)
				$command .= '-'.$key.' '.$value.' ';
			else
				$command .= '-'.$key.' ';
		}

		$command .= $this->overlay.' '.$this->base.' '.$this->outfile;
		return $command;
	}

}
