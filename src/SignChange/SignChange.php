<?php
namespace SignChange;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\tile\Tile;
use UiLibrary\UiLibrary;

class SignChange extends PluginBase {

    public $pre = "§e•";

    //public $pre = "§l§e[ §f시스템 §e]§r§e";

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->ui = UiLibrary::getInstance();
    }

    public function SignChangeUI(Player $player, Tile $block) {
        if (isset($this->block[$player->getId()]))
            return false;
        $this->block[$player->getId()] = $block;
        $form = $this->ui->CustomForm(function (Player $player, array $data) {
            $block = $this->block[$player->getId()];
            unset($this->block[$player->getId()]);
            if (!isset($data[2]))
                return false;
            $block->setText($data[2], $data[3], $data[4], $data[5]);
            $player->sendMessage("{$this->pre} 성공적으로 표지판을 수정하였습니다.");
        });
        $form->setTitle("Tele SignChange");
        $form->addLabel("§a▶ §f표지판을 수정합니다.");
        $form->addLabel("§c▶ §f해당 관리사항은 모두 로그로 기록되오니,\n  §f부정 사용으로 적발시 불이익이 있을 수 있습니다.");
        $form->addInput("Line 1", "Line 1", $block->getLine(0));
        $form->addInput("Line 2", "Line 2", $block->getLine(1));
        $form->addInput("Line 3", "Line 3", $block->getLine(2));
        $form->addInput("Line 4", "Line 4", $block->getLine(3));
        $form->sendToPlayer($player);
    }
}
