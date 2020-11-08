<?php
include "config.php";
include "function.php";

if(!isset($_GET[$hook_key])){
    die("FALSE");
}


logIt("\n\n-------".date("Y-m-d H:i:s")."---------");

$requestBody = file_get_contents('php://input');
logIt($requestBody);

$json = json_decode($requestBody,true);
/*
{
	"update_id": 390079359,
	"message": {
		"message_id": 6,
		"from": {
			"id": 249176760,
			"is_bot": false,
			"first_name": "Kang",
			"last_name": "iBNuX",
			"username": "ibnumaksum",
			"language_code": "id"
		},
		"chat": {
			"id": -205365134,
			"title": "Test wallet",
			"type": "group",
			"all_members_are_administrators": true
		},
		"date": 1574918216,
		"text": "@DZAwalletBot kirim ke @ibnux",
		"entities": [{
			"offset": 0,
			"length": 13,
			"type": "mention"
		}, {
			"offset": 23,
			"length": 6,
			"type": "mention"
        }],
        "new_chat_members": [{
			"id": 249176760,
			"is_bot": false,
			"first_name": "Kang",
			"last_name": "iBNuX",
			"username": "ibnumaksum",
			"language_code": "ms"
		}]
	}
}
*/
$message = trim($json['message']['text']);
$from_id = $json['message']['from']['id'];
$username = $json['message']['from']['username'];
$name = $json['message']['from']['first_name']." ".$json['message']['from']['last_name'];
$is_bot  = $json['message']['from']['is_bot'];
$chat_id  = $json['message']['chat']['id'];
$new_members = $json['new_chat_members'];

if($is_bot){
    die();
}

$isRoom = false;

//is room
if($chat_id<0){
    logIt("is Room");
    logIt("New Members ".count($new_members));
    if(count($new_members)>0){
        include "modul/greetNewMembers.php";
    }
    //if not mention
    if(strpos($message,'@'.$bot_username)===false){
        logIt("tidak ada mention");
        //tidak ada mention
        die();
    }else if(strpos($message,'@'.$bot_username)>0){
        logIt("bukan mention diawal");
        // mention bukan diawal
        die();
    }
    $isRoom = true;
    //hapus mention
    $message = trim(str_replace("@$bot_username ",'',$message));
}else{
    logIt("not Room");
}

/**
 * /command
 * will be
 * modul/command.php
 */

$msgs = explode(" ",$message);
$msgs[0] = str_replace("/","",strtolower($msgs[0]));
if(file_exists("modul/".$msgs[0].".php")){
    include "modul/".$msgs[0].".php";
}else{
    include "modul/help.php";
}

logIt(json_encode($db->getLogError(),JSON_PRETTY_PRINT));
?>true