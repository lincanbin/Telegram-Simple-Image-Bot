<?php
require_once 'TelegramBot.php';

class ImageBot extends TelegramBot {
	public function init() {
	parent::init();
	}
}


class ImageBotChat extends TelegramBotChat {
	public function __construct($core, $chat_id) {
	parent::__construct($core, $chat_id);
	}
	public function init() {
	}

	public function some_command($command, $params, $message) {
		switch ($command) {
			case 'start':
			case 'help':
				$this->apiSendMessage("我是一个脱离了高级趣味的Bot. /pic or /hentai ");
				break;
			case 'about':
				$this->apiSendMessage("https://github.com/lincanbin");
				break;
			case 'hentai':
			case 'cg':
				$this->returnRandomPicture("cg");
				break;
			default:
				$this->returnRandomPicture("images");
				break;
		}
		return;
	}


	public function message($text, $message) {
		$this->returnRandomPicture("images");
		return;
	}


	private function returnRandomPicture($dir_name){
		$image_list = scandir(__DIR__ . "/". $dir_name);
		$this->core->request('sendPhoto',
			 array(
				'chat_id' => $this->chatId,
				'photo' => "@" . __DIR__.  "/" .  $dir_name . "/" . $image_list[mt_rand(2,  (count($image_list)-1))]
			), 
			array(
				'http_method' => 'POST'
			)
		);
	}

}
