<?php

declare(strict_types=1);

namespace NhanAZ\FormDebug;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDataPacketReceive(DataPacketReceiveEvent $event) {
		$packet = $event->getPacket();

		if ($packet instanceof ModalFormResponsePacket) {
			$player = $event->getOrigin()->getPlayer()->getName();
			var_dump($player, $packet);
		}
	}

	public function onDataPacketSend(DataPacketSendEvent $event) {
		$packets = $event->getPackets();

		foreach ($packets as $packet) {
			if ($packet instanceof ModalFormRequestPacket) {
				$targetArr = [];
				$targets = $event->getTargets();
				foreach ($targets as $target) {
					array_push($targetArr, $target->getPlayer()->getName());
				}
				var_dump($targetArr, $packet);
			}
		}
	}
}
