<?php

namespace appveo\Library\Script\Fight\Mode;

use appveo\Library\Script\Fight\Mode\Base;
use appveo\Library\Script\Fight\Log\Round;

class Deathmatch extends Base
{
	
	private $turn;
	
	public function isExecutable()
	{
		if(count($this->getContext()->getPlayers()) < 2)
			throw new \LengthException("More than one player is needed in this mode.");
			
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
		$this->turn = $offender;
		
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
			->setHealthpoints($defender->getHealthpoints())
		;

		$log->addRound($round);
		
	}
	
	private function nextPlayer()
	{
		$players = $this
			->getContext()
			->getPlayers()
		;
		
		$key = array_rand($players);
		$pickup = $players[$key];
		
		if($pickup === $this->turn)
		{
			$keys = array_keys($players);
			
			$nextkey = array_search($key, $keys) + 1;
			if($nextkey == count($keys))
			    $nextkey = 0;

			return $players[
				$keys[$nextkey]
			];
		}
		else
		{
			return $pickup;
		}
	}
	
}