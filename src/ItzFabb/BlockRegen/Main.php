<?php



namespace ItzFabb\BlockRegen;



use pocketmine\block\Block;

use pocketmine\event\block\BlockBreakEvent;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\utils\Config;

use onebone\economyapi\EconomyAPI;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;

use pocketmine\network\mcpe\protocol\LevelEventPacket;



class Main extends PluginBase implements Listener{



    private $config;



    public function onEnable()

    {

    	   $this->economyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->saveResource("config.yml");

        $this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);

    }



    public function onBlockBreak(BlockBreakEvent $event){

        $player = $event->getPlayer();

        $block = $event->getBlock();

        /**

         * COAL

         * 

         * */

        if($block->getLevel()->getName() === $this->config->get("WORLD-ENABLE")){

            if($block->getId() === Block::COAL_ORE && $this->config->get("COAL_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §8Coal Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $coalp = $this->config->get("coal-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $coalp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $coalp, "Coal Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::IRON_ORE && $this->config->get("IRON_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §fIron Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $ironp = $this->config->get("iron-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $ironp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $ironp, "Iron Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::GOLD_ORE && $this->config->get("GOLD_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §eGold Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $goalp = $this->config->get("gold-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $goalp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $goalp, "Gold Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::DIAMOND_ORE && $this->config->get("DIAMOND_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §bDiamond Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $diamondp = $this->config->get("diamond-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $diamondp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $diamondp, "Diamond Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::EMERALD_ORE && $this->config->get("EMERALD_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §aEmerald Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $emeraldp = $this->config->get("emerald-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $emeraldp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $emeraldp, "Emerald Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::QUARTZ_ORE && $this->config->get("QUARTZ_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §fQuartz Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $quartzp = $this->config->get("quartz-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $quartzp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $quartzp, "Quartz Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::LAPIS_ORE && $this->config->get("LAPIS_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §9Lapis Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $lapisp = $this->config->get("lapis-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $lapisp); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $lapisp, "Lapis Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::REDSTONE_ORE && $this->config->get("REDSTONE_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §cRedstone Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $redstonep = $this->config->get("redstone-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $redstonep); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $redstonep, "Redstone Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::GLOWING_REDSTONE_ORE && $this->config->get("REDSTONE_ORE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §cRedstone Ore!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $redstonep = $this->config->get("redstone-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $redstonep); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $redstonep, "Redstone Ore"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            } elseif($block->getId() === Block::STONE && $this->config->get("STONE") === true){

            	foreach ($event->getDrops() as $drop) {

            		$event->getPlayer()->getInventory()->addItem($drop);

            	}

             	 $event->setCancelled();

                $event->setXpDropAmount(0);

                $player->addXp(1);

                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::BEDROCK));

                $this->getScheduler()->scheduleDelayedTask(new DelayTask($this, $block), 20 * $this->config->get("REGEN-DELAY"));

                if($this->config->get("SEND-MESSAGE") == "true") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                	$player->sendMessage("§a§l> §r§7You've mined §8Stone!");

                }

                if($this->config->get("SEND-MESSAGE") == "false") {

                	$player->getLevel()->broadcastLevelSoundEvent($player->add(0, $player->eyeHeight, 0), LevelSoundEventPacket::SOUND_BREAK);

                }

                if($this->config->get("ECONOMY-ENABLE") == "true") {

                 	 $stonep = $this->config->get("stone-price");

                	 $volume = mt_rand();

	                $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

	                $this->economyAPI->addMoney($player, $stonep); 

                }

                if($this->config->get("MINE-LOG-TYPE") == "true") {

                	$moneygained = $this->config->get("MINE-LOG-LOG");

                	$placeholders = str_replace(["{money}", "{gained}", "{ore-type}"], [$this->economyAPI->myMoney($player), $stonep, "Stone"], $moneygained);

                	$player->sendTip($placeholders);

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

                if($this->config->get("MINE-LOG-TYPE") == "false") {

                	$volume = mt_rand();

	               $player->getLevel()->broadcastLevelEvent($player, LevelEventPacket::EVENT_SOUND_ORB, (int) $volume);

                }

            }

        }

    }

}
