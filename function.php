<?php
function kirimPesan($chat_id,$pesan){
    global $bot_api_key;

    $data = array(
        'chat_id' => $chat_id,
        'text' => $pesan,
        'parse_mode' => 'html'
    );

    $url = "https://api.telegram.org/bot$bot_api_key/sendMessage";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    logIt($result);
}


function logIt($txt){
    global $log_path,$logit;
    if($logit)
        file_put_contents($log_path,$txt."\n",FILE_APPEND);
}