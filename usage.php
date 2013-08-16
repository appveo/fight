<?php

include "appveo/Launcher.php";

use appveo\Library\Script\Fight\Context;
use appveo\Library\Script\Fight\Player\Human;
use appveo\Library\Script\Fight\Team\Team;
use appveo\Library\Script\Fight\Mode\Duel;
use appveo\Library\Script\Fight\Mode\Deathmatch;
use appveo\Library\Script\Fight\Mode\TeamDeathmatch;

/**
 * setup teams
 */
$teamA = new Team;
$teamA->setColor('red');

$teamB = new Team;
$teamB->setColor('blue');

/**
 * create and match to teams
 */
$player1 = new Human;
$player1
	->setName('Player 1')
	->setTeam($teamA)
;

$player2 = new Human;
$player2
	->setName('Player 2')
	->setTeam($teamA)
;

$player3 = new Human;
$player3
	->setName('Player 3')
	->setTeam($teamB)
;

$player4 = new Human;
$player4
	->setName('Player 4')
	->setTeam($teamB)
;

/**
 * create fight context and add players
 */

$context = new Context;
$context
	->addPlayer($player1)
	->addPlayer($player2)
	->addPlayer($player3)
	->addPlayer($player4)
	->setMode(new TeamDeathmatch)
	->execute()
;

// output

print("Appveo fight script (Team A vs Team B)<br><br>");

foreach($context->getLog() as $round)
{
	print("<span style='color: {$round->getOffender()->getTeam()->getColor()}'>{$round->getOffender()->getName()}</span> attacks <span style='color: {$round->getDefender()->getTeam()->getColor()}'>{$round->getDefender()->getName()}</span><br>");
	print("{$round->getDamage()} damage<br>");
	print("{$round->getDefender()->getHealthpoints()} Healthpoints left<br><br>");
}