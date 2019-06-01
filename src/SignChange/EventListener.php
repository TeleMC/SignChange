<?php
namespace SignChange;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class EventListener implements Listener {

    public function __construct(SignChange $plugin) {
        $this->plugin = $plugin;
    }

    public function onTouch(PlayerInteractEvent $ev) {
        if ($ev->getItem()->getId() == 280 && $ev->getPlayer()->isOp() && ($ev->getBlock()->getId() == 63 || $ev->getBlock()->getId() == 68)) {
            $this->plugin->SignChangeUI($ev->getPlayer(), $ev->getPlayer()->getLevel()->getTile($ev->getBlock()));
        }
    }
}
