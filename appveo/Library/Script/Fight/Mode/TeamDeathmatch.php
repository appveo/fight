<?php

namespace appveo\Library\Script\Fight\Mode;

use appveo\Library\Script\Fight\Mode\Base;
use appveo\Library\Script\Fight\Team\Team;
use appveo\Library\Script\Fight\Log\Round;

class TeamDeathmatch extends Base
{
	
	private $turn;
	
	public function isExecutable()
	{
		if(
			(count($this->getContext()->getTeams()) < 2) 
		    OR (count($this->getContext()->getPlayers()) < 2)
		)	
			throw new \LengthException("More than one player / teams is required in this mode.");
			
		return true;
	}
	
	public function isContinuable()
	{
		return count($this->getContext()->getTeams()) > 1;
	}
	
	public function doFight()
	{
		$context = $this->getContext();
		
		$team = $this->nextTeam();
		$this->turn = $team;
		$offender = $this->nextPlayer($team);
		$defender = $this->nextPlayer($this->nextTeam());
		
		$attackrate = $offender->performAttack();
		$defencerate = $defender->performDefence();
		
		$damage = $attackrate - $defencerate;
		
		if($damage > 0)
		{
			$defender->setHealthpoints($defender->getHealthpoints() - $damage);
			if($defender->getHealthpoints() <= 0)
			{
				$defender->setHealthpoints(0);
				$context->removePlayer($defender);
				$context->removeTeammember($defender);
				if(!count($context->getTeammembers($defender->getTeam())) > 0)
					$context->removeTeam($defender->getTeam());
			}
		}
		else
		{
			$damage = 0;
		}
		
		$log = $context->getLog();
		
		$round = new Round;
		
		$round
			->setNumber($context->getRoundNumber())
			->setOffender($offender)
			->setDefender($defender)
			->setDamage($damage)
			->setHealthpoints($defender->getHealthpoints())
		;

		$log->addRound($round);
		
	}
	
	private function nextPlayer(Team $team)
	{
		$players = $this
			->getContext()
			->getTeammembers($team)
		;
		
		$key = array_rand($players);
		$pickup = $players[$key];
		
		return $pickup;
	}
	
	private function nextTeam()
	{
		$teams = $this
			->getContext()
			->getTeams()
		;
		
		$key = array_rand($teams);
		$pickup = $teams[$key];
		
		if($pickup === $this->turn)
		{
			$keys = array_keys($teams);
			
			$nextkey = array_search($key, $keys) + 1;
			if($nextkey == count($keys))
			    $nextkey = 0;

			return $teams[
				$keys[$nextkey]
			];
		}
		else
		{
			return $pickup;
		}
	}
}