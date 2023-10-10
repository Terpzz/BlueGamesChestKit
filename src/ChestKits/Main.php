<?php

declare(strict_types=1);

namespace ChestKits;

use pocketmine\command\{Command, CommandSender};
use pocketmine\inventory\ChestInventory;
use pocketmine\item\Item;
use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\nbt\{NBT, tag\CompoundTag, tag\ListTag, tag\StringTag};
use pocketmine\tile\Chest;
use pocketmine\utils\TextFormat as C;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;

class Main extends PluginBase {

    public function onEnable() : void {
        $this->getLogger()->info("ChestKits Enabled");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {

        if(!$sender instanceof Player){
            $sender->sendMessage(TextFormat::RED . "Command must be used in-game.");
            return true;
        }
        switch($command){
            case "kit":
                $helmet = VanillaItems::DIAMOND_HELMET(); // Use VanillaItems::DIAMOND_HELMET() to create a diamond helmet
                $helmet->setCustomName("Kit Helmet");
                $chestplate = VanillaItems::DIAMOND_CHESTPLATE(); // Use VanillaItems::DIAMOND_CHESTPLATE() to create a diamond chestplate
                $chestplate->setCustomName("Kit Chestplate");
                $leggings = VanillaItems::DIAMOND_LEGGINGS(); // Use VanillaItems::DIAMOND_LEGGINGS() to create diamond leggings
                $leggings->setCustomName("Kit Leggings");
                $boots = VanillaItems::DIAMOND_BOOTS(); // Use VanillaItems::DIAMOND_BOOTS() to create diamond boots
                $boots->setCustomName("Kit Boots");
                $sword = VanillaItems::DIAMOND_SWORD(); // Use VanillaItems::DIAMOND_SWORD() to create a diamond sword
                $sword->setCustomName("Kit Sword");
                $nbt = new CompoundTag("BlockEntityTag", [new ListTag("Items", [$helmet->nbtSerialize(0), $chestplate->nbtSerialize(1), $leggings->nbtSerialize(2), $boots->nbtSerialize(3), $sword->nbtSerialize(4)])]);
                $chest = VanillaBlocks::CHEST()->asItem(); // Use VanillaBlocks::CHEST()->asItem() to create a chest item
                $chest->setNamedTagEntry($nbt);
                $chest->setCustomName("Kit");
                $sender->getInventory()->addItem($chest);
                break;
        }
        return true; 
    }
}
