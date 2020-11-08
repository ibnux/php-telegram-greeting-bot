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
$message = trim($json['message']['text']);
$from_id = $json['message']['from']['id'];
$username = $json['message']['from']['username'];
$name = $json['message']['from']['first_name']." ".$json['message']['from']['last_name'];
$is_bot  = $json['message']['from']['is_bot'];
$chat_id  = $json['message']['chat']['id'];
$room_title  = $json['message']['chat']['title'];
$new_members = $json['message']['new_chat_members'];

if($is_bot){
    die("true");
}
$greeting = str_replace('{room}',
    $room_title,
    $greeting);

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
        die("true");
    }else if(strpos($message,'@'.$bot_username)>0){
        logIt("bukan mention diawal");
        // mention bukan diawal
        die("true");
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
?>true