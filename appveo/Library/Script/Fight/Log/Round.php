<?php

namespace appveo\Library\Script\Fight\Log;

use appveo\Library\Script\Fight\Player\Base as Player;

class Round
{
	private $number;
	private $offender;
	private $defender;
	private $damage;
	private $healthpoints;
	
	public function setNumber($number)
	{
		$this->number = $number;
		return $this;
	}
	
	public function getNumber()
	{
		return $this->number;
	}
	
	public function setOffender(Player $offender)
	{
		$this->offender = clone $offender;
		return $this;
	}
	
	public function getOffender()
	{
		return $this->offender;
	}
	
	public function setDefender(Player $defender)
	{
		$this->defender = clone $defender;
		return $this;
	}
	
	public function getDefender()
	{
		return $this->defender;
	}
	
	public function setDamage($damage)
	{
		$this->damage = $damage;
		return $this;
	}
	
	public function getDamage()
	{
		return $this->damage;
	}

	public function setHealthpoints($healthpoints)
	{
		$this->healthpoints = $healthpoints;
		return $this;
	}

	public function getHealthpoints()
	{
		return $this->healthpoints;
	}
}