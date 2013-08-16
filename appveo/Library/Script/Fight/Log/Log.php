<?php

namespace appveo\Library\Script\Fight\Log;

use appveo\Library\Script\Fight\Log\Round;

class Log implements \IteratorAggregate
{
	
	protected $rounds;
	
	public function getIterator()
	{
		return new \ArrayIterator($this->rounds);
	}
	
	public function addRound(Round $round)
	{
		$this->rounds[] = $round;
		return $this;
	}
	
}