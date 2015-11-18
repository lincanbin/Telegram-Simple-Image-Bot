<?php
require_once 'TelegramBot.php';

class ImageBot extends TelegramBot {
	public function init() {
	parent::init();
	}
}


class ImageBotChat extends TelegramBotChat {
	private $responseTable = array(
		'黄图' => array('text'=>'要优雅不要污'),
		'女装' => array('text'=>'窝也好想要女装……然后和大姐姐一起玩。'),
		'肛' => array('text'=>'窝也好想被大姐姐用双头龙肛'),
		'大吊' => array('text'=>'谁的屌有窝大？'),
		'大屌' => array('text'=>'谁的屌有窝大？'),
		'噫' => array('text'=>'
🌚🌚🌚🌚🌚🌚🌚🌚🌚🌚🌝🌚🌚🌚🌚🌚
🌚🌚🌚🌚🌚🌚🌚🌚🌚🌚🌚🌝🌚🌚🌝🌚
🌚🌝🌝🌝🌝🌚🌝🌝🌝🌝🌝🌝🌝🌝🌝🌝
🌚🌝🌚🌚🌝🌚🌚🌚🌝🌚🌚🌚🌚🌝🌚🌚
🌚🌝🌚🌚🌝🌚🌚🌚🌚🌝🌚🌚🌝🌚🌚🌚
🌚🌝🌚🌚🌝🌚🌝🌝🌝🌝🌝🌝🌝🌝🌝🌝
🌚🌝🌚🌚🌝🌚🌚🌚🌚🌚🌚🌚🌚🌚🌚🌚
🌚🌝🌚🌚🌝🌚🌚🌝🌝🌝🌝🌝🌝🌝🌝🌚
🌚🌝🌚🌚🌝🌚🌚🌝🌚🌚🌚🌚🌚🌚🌝🌚
🌚🌝🌝🌝🌝🌚🌚🌝🌝🌝🌝🌝🌝🌝🌝🌚
🌚🌝🌚🌚🌝🌚🌚🌝🌚🌚🌚🌚🌚🌚🌝🌚
🌚🌝🌚🌚🌚🌚🌚🌝🌝🌝🌝🌝🌝🌝🌝🌚
🌚🌚🌚🌚🌚🌚🌝🌚🌝🌚🌝🌚🌚🌚🌚🌝
🌚🌚🌚🌚🌚🌚🌝🌚🌝🌚🌚🌝🌚🌝🌚🌚
🌚🌚🌚🌚🌚🌝🌚🌚🌝🌚🌚🌚🌚🌝🌚🌚
🌚🌚🌚🌚🌚🌚🌚🌚🌚🌝🌝🌝🌝🌝🌚🌚'),
		'😂' => array('text'=>'😂😂😂'),
		'🌝' => array('text'=>'🌚')
	);
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
				$this->returnPicture($this->getRandomPicturePath("cg"));
				break;
			default:
				$this->returnPicture($this->getRandomPicturePath("images"));
				break;
		}
		return;
	}


	public function message($text, $message) {
		foreach ($this->responseTable as $key => $value) {
			if(strpos($text, $key) !== false){
				$this->apiSendMessage($value['text']);
				break;
			}
		}
		return;
	}

	private function getRandomPicturePath($dir_name){
		$image_list = scandir(__DIR__ . "/". $dir_name);
		return "@" . __DIR__.  "/" .  $dir_name . "/" . $image_list[mt_rand(2,  (count($image_list)-1))];
		
	}

	private function returnPicture($path){
		$this->core->request('sendPhoto',
			 array(
				'chat_id' => $this->chatId,
				'photo' => $path
			), 
			array(
				'http_method' => 'POST'
			)
		);
	}

}