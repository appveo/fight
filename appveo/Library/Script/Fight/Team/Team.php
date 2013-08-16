<?php

namespace appveo\Library\Script\Fight\Team;

class Team
{
	private $color;
	
	public function __construct()
	{
		$this->color = "#000000";
	}
	
	public function getColor()
	{
		return $this->color;
	}
	
	public function setColor($color)
	{
		$this->color = $color;
		return $this;
	}
}