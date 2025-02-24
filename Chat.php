<?php

namespace PersianChatFix;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat as TF;

class PersianChatFix extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TF::GREEN . "پلاگین بهبود چت فارسی فعال شد!");
    }

    public function onChat(PlayerChatEvent $event): void {
        $message = $event->getMessage();

        // حذف فاصله‌های اضافی در فارسی
        $message = preg_replace('/\s+/', ' ', $message);

        // جایگزینی اموجی‌های خاص
        $emoji_replacements = [
            "❤️" => "❤",
            "💙" => "💜",
            "😂" => "😆",
        ];
        $message = str_replace(array_keys($emoji_replacements), array_values($emoji_replacements), $message);

        // راست‌چین کردن متن در برخی سرورها
        $message = "» " . $message;

        $event->setMessage($message);
    }
}
