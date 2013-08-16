<?php

namespace appveo\Library\Script\Fight\Mode;

use appveo\Library\Script\Fight\Context;

abstract class Base
{
	abstract public function isExecutable();
	abstract public function isContinuable();
	abstract public function doFight();
	
	private $context;
	
	public function setContext(Context $context)
	{
		$this->context = $context;
		return $this;
	}
	
	public function getContext()
	{
		return $this->context;
	}
}