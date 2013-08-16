<?php

namespace appveo\Library\Script\Fight\Player;

use appveo\Library\Script\Fight\Player\Base;

class Human extends Base
{
	public function __construct()
	{
		$this->name = "Human";
		$this->healthpoints = 100;
		$this->attackrate = 20;
		$this->defencerate = 10;
	}
	
	public function performAttack()
	{
		return $this->attackrate * rand(1,10);
	}
	
	public function performDefence()
	{
		return $this->defencerate * rand(1,10);
	}
}