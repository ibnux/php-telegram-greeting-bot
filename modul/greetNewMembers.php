<?php

foreach($new_members as $member){
    logIt("Process ".count($member['id']));
    if(empty($member['username'])){
        $message = str_replace('{name}',
                '<a href="tg://user?id='.$member['id'].'">'.$member['first_name'].' '.$member['last_name'].'</a>',
                $message);
    }else{
        $message = str_replace('{name}',
                '@'.$member['username'],
                $message);
    }
    $msg .= "\nDari mana asalnya?";
    if(empty($member['username'])){
        $msg .= "\nMohon setting username agar mudah mentionnya";
        kirimPesan($chat_id,$msg);
    }else{
        kirimPesan($chat_id,$msg);
    }
}