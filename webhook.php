<?php
require(__DIR__ . "/config.php");
require(__DIR__ . "/ImageBot.php");

define('BOT_WEBHOOK', 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$bot = new ImageBot(BOT_TOKEN, 'ImageBotChat');
if (isset($_GET['wekhook'])) {
	echo $_GET['wekhook'];
	if ($_GET['wekhook'] == 'set') {
		$bot->setWebhook(BOT_WEBHOOK);
		echo BOT_WEBHOOK;
	} else if ($argv[1] == 'remove') {
		$bot->removeWebhook();
	}
	exit;
}

$response = file_get_contents('php://input');
$update = json_decode($response, true);
//var_dump($update);
$bot->init();
$bot->onUpdateReceived($update);