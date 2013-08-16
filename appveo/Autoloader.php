<?php

function appveoLauncher($classname)
{
	$file = str_replace("\\", "/", $classname).".php";
	if(!file_exists($file))
		throw new BadFunctionCallException("Class {$classname} not found");
	
	include $file;
	
}