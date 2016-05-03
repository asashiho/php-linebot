<?php

/*==========================
*
* 文字の中の改行はjsonなので「\\n」
*
==========================*/

// LINE BOT API アカウント情報（https://business.line.me/services/）
$channel_id = "1463112652";
$channel_secret = "64e93d09b34d95aaa94342b68cb14e13";
$mid = "u7d4ac40417e845c9b8e132fe1d86869d";

// コンテンツ情報
// 相手にあげる画像のリンク元
$original_content_url_for_image = "https://www.asa.yokohama/docker.png";
$preview_image_url_for_image = $original_content_url_for_image;
// $preview_image_url_for_image = "http://hogehoge.com/example01_thum.jpg";　←サムネ画像別にするなら

// 相手にあげる動画のリンク元
$original_content_url_for_video = "https://www.asa.yokohama/docker.png";
$preview_image_url_for_video = "http://hogehoge.com/example02_thum.jpg"; /* サムネは画像ファイル */

// 相手にあげる自分の位置情報→経度・緯度調べ方（http://bit.ly/1VcLEdV）
$original_content_location_name = "あさがよくいる場所"; /* 場所の名称 */
$original_content_location_latitude = "35.681382"; /* 緯度（ここは仮で東京駅ね） */
$original_content_location_longitude = "139.766084"; /* 経度 */


// 画像が送られた時の返答メッセ
$get_image = "素敵な写真をありがとうございます！";

// 動画が送られた時の返答メッセ
$get_video = "素敵なビデオをありがとうございます！";

// 音声が送られた時の返答メッセ
$get_audio = "素敵な音声をありがとうございます！";

// 位置情報が送られた時の返答メッセ
$get_location = "きっと素敵な場所なんでしょうね。行ってみたいな！";

// スタンプが送られた時の返答メッセ
$get_stamp = "素敵なスタンプですね！僕も買おうかな！";

// 任意なテキストが送られた時の返答メッセ
$get_message_before = "おや。。。\\n\\n「"; /* ユーザーが入力した文字の前 */
$get_message_after = "」とは素敵なことを言いますね～"; /* ユーザーが入力した文字の後 */

// ルール説明
$rule = "【遊び方】\\n\\n「画像」と話かけると、写真がもらえます。\\n「動画」と話かけると、動画がもらえます。\\n「位置」と話かけると、○○のよくいる場所が教えてもらえます。\\n\\n全部欲しい欲張りなあなたは「全部」って言ってみて。\\n\\nまた、あなたの写真、ビデオ、音声、今いる場所やスタンプを送ってくれると嬉しいな～";
