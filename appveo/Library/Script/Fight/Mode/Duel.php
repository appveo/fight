<?php

namespace appveo\Library\Script\Fight\Mode;

use appveo\Library\Script\Fight\Mode\Base;
use appveo\Library\Script\Fight\Log\Round;

class Duel extends Base
{
	
	private $turn;
	
	public function isExecutable()
	{
		if(count($this->getContext()->getPlayers()) !== 2)
			throw new \LengthException("Invalid numbers of players. Only 2 are allowed in this mode.");
		return true;
	}
	
	public function isContinuable()
	{
		return count($this->getContext()->getPlayers()) > 1;
	}
	
	public function doFight()
	{
		
		$context = $this->getContext();
		
		$offender = $this->nextPlayer();
		$defender = $this->nextPlayer();
		
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
		;

		$log->addRound($round);
		
	}
	
	private function nextPlayer()
	{
		$players = $this
			->getContext()
			->getPlayers()
		;
		
		$key = array_keys($players);
		
		if($this->turn == $players[$key[0]])
			$this->turn = $players[$key[1]];
		else
			$this->turn = $players[$key[0]];
			
		return $this->turn;
	}
	
}