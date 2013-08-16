<?php

namespace appveo\Library\Script\Fight\Player;

use appveo\Library\Script\Fight\Team\Team;

abstract class Base
{
	
	protected $name;
	protected $healthpoints;
	protected $attackrate;
	protected $defencerate;
	
	protected $team;
	
	abstract public function __construct();
	abstract public function performAttack();
	abstract public function performDefence();
	
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	public function getName()
	{
		return $this->name;
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
	
	public function setAttackrate($attackrate)
	{
		$this->attackrate = $attackrate;
		return $this;
	}
	
	public function getAttackrate()
	{
		return $this->attackrate;
	}
	
	public function setDefencerate($defencerate)
	{
		$this->defencerate = $defencerate;
		return $this;
	}
	
	public function getDefencerate()
	{
		return $this->defencerate;
	}
	
	public function setTeam(Team $team)
	{
		$this->team = $team;
		return $this;
	}
	
	public function getTeam()
	{
		return $this->team;
	}
	
}