<?php
$logit = true;
$log_path = "./logs/telegram.log";

# generate from https://www.uuidgenerator.net/
$hook_key = "a26dd107-c48a-469e-bf7c-4d1c519dssasa";

# from t.me/BotFather
$bot_api_key  = 'adadsaasas';
$bot_username = 'NengEuisBot';

# must be https
$hook_url     = 'https://'.$_SERVER['HTTP_HOST'].'/hook.php?'.$hook_key;

/**
 * {name} for username
 * {room} for group title
 */

$message = "Hi {name},
Selamat datang di {room}
Dari mana asalanya?
profesinya apa?";