appveo fight script
v3.0.1

FANCY PHP 5.3 FIGHT SCRIPT WITH THREE DIFFERENT MODES, 10 WARRIOR MODELS AND 100 ITEMS

New features:
- fast, secure performance
- reinvention of the user implementation (easier, less code and easy to integrate in other frameworks)
- 10 warrior models
- 100 items (weapons, armory, magic-tools)
- editable interfaces (write own features)

and many more!

TUTORIAL
-------------------

1. import and create context

use appveo\Library\Script\Fight\Context;
$context = new Context;

2. add players and choose a warrior model (Human / Org etc)

use appveo\Library\Script\Fight\Model\Human;
$context
	->addPlayer(new Human)
	->addPlayer(new Human)
;

3. setup mode

use appveo\Library\Script\Fight\Mode\Duel;
$context->setMode(new Duel);

4. execute fight

$context->execute();

5. retrieve information from the logging feature

foreach($context->getLog() as $round)
{
	print_r($round);
}