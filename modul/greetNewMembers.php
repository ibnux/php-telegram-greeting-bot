<?php

foreach($new_members as $member){
    logIt("Process ".count($member['id']));
    if(!$member['is_bot']){
        if(empty($member['username'])){
            $greeting = str_replace('{name}',
                    '<a href="tg://user?id='.$member['id'].'">'.$member['first_name'].' '.$member['last_name'].'</a>',
                    $greeting);
        }else{
            $greeting = str_replace('{name}',
                    '@'.$member['username'],
                    $greeting);
        }
        if(empty($member['username'])){
            kirimPesan($chat_id,$greeting);
        }else{
            kirimPesan($chat_id,$greeting);
        }
    }
}