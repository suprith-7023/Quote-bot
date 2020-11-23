<?php
/*
BY:- @BenchamXD

CHANNEL:- @IndusBots
*/
error_reporting(0);

set_time_limit(0);

flush();
##------------------------------##
$API_KEY = $_ENV["BOT_TOKEN"]; // bot token

define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
//===============HEROKU TEST=================//
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$username = $update->message->from->username;
$chatid = $update->callback_query->message->chat->id;
$START_MESSAGE = $_ENV["START_MESSAGE"] = "USE /GET";
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE***",
'parse_mode'=>"MarkDown",
]);
if($text == '/get'){

$data = json_decode(file_get_contents("https://quotes.cwprojects.live/random"),true);
$text = $data['text'];
$author = $data['author'];
$tag1 = $data['tags'][0];
$tag2 = $data['tags'][1];
$tag3 = $data['tags'][2];

bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"
***QUOTE:- ***`$text`

***AUTHOR:-*** `$author`

***TAGS:-*** #$tag1 #$tag2 #$tag3",
'parse_mode'=>"MarkDown",
                ]);
}
