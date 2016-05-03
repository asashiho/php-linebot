<?php

//設定ファイル参照
require_once('config.php');
$event_type = "138311608800106203"; // システム固定値

// LINEからのメッセージ受信
$jsonObj = json_decode(file_get_contents('php://input'));
$content = $jsonObj->result{0}->content;
$text = $content->text;
$from = $content->from;
$messageId = $content->id;
$contentType = $content->contentType;


// データが画像であれば保存し、画像認識APIを呼び出す
if ($contentType == 2) {
    getContent($messageId);
    getDocomo($messageId);
}

// 受信メッセージに応じて返すメッセージを変更
//if ($contentType != 1) {
//    $text = "テキスト以外";
//}


// LINE Bot APIへの返信処理
//返信データの作成
$post = <<< EOM
{
    "to":["{$from}"],
    "toChannel":1383378250,
    "eventType":"{$event_type}",
    "content":{
        "toType":1,
        "contentType":1,
        "text":"{$text}"
    }
}
EOM;

doPost($post);


// POST処理
function doPost($post) {

    $url = "https://trialbot-api.line.me/v1/events";
    $headers = array(
        "Content-Type: application/json",
        "X-Line-ChannelID: {$GLOBALS['channel_id']}",
        "X-Line-ChannelSecret: {$GLOBALS['channel_secret']}",
        "X-Line-Trusted-User-With-ACL: {$GLOBALS['mid']}"
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curl);
}

// 画像ファイル保存
function getContent($messageId) {
    $url = "https://trialbot-api.line.me/v1/bot/message/{$messageId}/content";
    $headers = array(
        "X-Line-ChannelID: {$GLOBALS['channel_id']}",
        "X-Line-ChannelSecret: {$GLOBALS['channel_secret']}",
        "X-Line-Trusted-User-With-ACL: {$GLOBALS['mid']}"
    ); 

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curl);
    file_put_contents("/tmp/{$messageId}.jpeg", $output);
}

// 画像認識API呼び出し
function getDocomo($messageId) {
    $url = "https://api.apigw.smt.docomo.ne.jp/imageRecognition/v1/concept/classify/";


    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL         => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST        => true,
        CURLOPT_POSTFIELDS  => [
            'modelName'  => 'flower',
            'image' => new CURLFile('/tmp/{$messageId}.jpeg')
        ],
    ]);
    
    $output = curl_exec($ch);

    #$output = curl_exec($curl);
    file_put_contents("/tmp/{$messageId}.txt", $output);

}
