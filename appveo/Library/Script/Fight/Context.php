<?php

namespace appveo\Library\Script\Fight;

use appveo\Library\Script\Fight\Mode\Base as Mode;
use appveo\Library\Script\Fight\Player\Base as Player;
use appveo\Library\Script\Fight\Team\Team;
use appveo\Library\Script\Fight\Log\Log;

class Context
{
	
	private $roundnumber;
	private $log;
	
	public function __construct()
	{
		$this->log = new Log;
	}
	
	public function addPlayer(Player $player)
	{
		$this->players[spl_object_hash($player)] = $player;
		
		if($player->getTeam() instanceof Team)
		{
			$team = $player->getTeam();
			$this->teams[spl_object_hash($team)] = $team;
			$this->teammembers[spl_object_hash($team)][spl_object_hash($player)] = $player;
		}
		
		return $this;
	}
	
	public function setMode(Mode $mode)
	{
		$this->mode = $mode->setContext($this);
		return $this;
	}
	
	public function execute()
	{
		if(!$this->mode->isExecutable())
			return;
			
		while($this->mode->isContinuable())
		{
			$this->mode->doFight();
			$this->roundnumber++;
		}
	}
	
	public function getLog()
	{
		return $this->log;
	}
	
	public function getPlayers()
	{
		return $this->players;
	}
	
	public function removePlayer(Player $player)
	{
		unset(
			$this->players[spl_object_hash($player)]
		);
		return $this;
	}
	
	public function getRoundNumber()
	{
		return $this->roundnumber;
	}
	
	public function getTeams()
	{
		return $this->teams;
	}
	
	public function getTeammembers(Team $team)
	{
		if(!key_exists(spl_object_hash($team), $this->teammembers))
			throw new \OutOfRangeException("key #{spl_object_hash($team)} not found in team member stack");
		return $this->teammembers[spl_object_hash($team)];
	}
	
	public function removeTeammember(Player $player)
	{
		unset(
			$this->teammembers[spl_object_hash($player->getTeam())][spl_object_hash($player)]
		);
		return $this;
	}
	
	public function removeTeam(Team $team)
	{
		unset(
			$this->teams[spl_object_hash($team)]
		);
		return $this;
	}
	
}