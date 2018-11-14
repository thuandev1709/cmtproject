<?php
//================================================================================
// Create invite token
//================================================================================
function inviteTokenGenerator($length = 30) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyz', ceil($length/strlen($x)) )),1,$length);
}

//================================================================================
// Date when add to database
//================================================================================
function dateInsert(){
  return date('YmdHis');
}

//================================================================================
// Date format 2018/12/15
//================================================================================
function formatDate($date){
  $newDate = date("Y/m/d", strtotime($date));
  return $newDate;
}



//================================================================================
// Decrypt / Encrypt
//================================================================================
// function string_secure($action, $string) {
//     $output = false;
//     $encrypt_method = "AES-256-CBC";
//     $secret_key = 'suzuki';
//     $secret_iv = 'coffee';
//     // hash
//     $key = hash('sha256', $secret_key);

//     // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
//     $iv = substr(hash('sha256', $secret_iv), 0, 16);
//     if ( $action == 'encrypt' ) {
//         $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
//         $output = base64_encode($output);
//     } else if( $action == 'decrypt' ) {
//         $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
//     }
//     return $output;
// }
function protect_url($action, $string, $pass){
  $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_iv = 'coffee';
    $key = hash('sha256', $pass);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypted' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypted' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

//================================================================================
// Convert text to fullwidth text
//================================================================================
function conv_str($str) {
  // 「全角スペース」を「半角スペース」に変換
  $str = mb_convert_kana($str, "s", "UTF-8");
  // 「タブ」を「半角スペース」に変換
  $str = preg_replace("/\t/", " ", $str);
  // 複数文字の「半角スペース」を1文字に変換
  $str = preg_replace("/[ ]+/", " ", $str);
  // 前後の「半角スペース」を削除
  $str = trim($str, " ");
  // 「全角英数字」を「半角」に変換
  $str = mb_convert_kana($str, "a", "UTF-8");
  // 「濁点」付きの文字を一文字に変換
  $str = mb_convert_kana($str, "V", "UTF-8");
  // 「半角カタカナ」を「全角カタカナ」に変換
  $str = mb_convert_kana($str, "K", "UTF-8");
  // 「濁点」を削除
  $str = preg_replace("/゛/", "", $str);
  // 「半濁点」を削除
  $str = preg_replace("/゜/", "", $str);
  // 適用可能な文字を全てHTMLエンティティに変換
  $str = htmlentities($str, ENT_QUOTES, "UTF-8");
  return $str;
}

//================================================================================
// Send mail function
//================================================================================
function send_mail($tomail, $subject, $body){
  $body = mb_convert_encoding($body, "ISO-2022-JP","AUTO");
  $from_mail = 'email@bellezavietnam.vn';
  $from_name = 'Leme Shop';
  $header  = "Return-Path: $from_mail\n";
  $header .= "From:" . mb_encode_mimeheader($from_name) . "<$from_mail>\n";
  $header .="MIME-Version: 1.0\r\nContent-Type: text/html; charset=ISO-2022-JP\r\n";
  $header .= "Reply-To: $from_mail\n";
  return mb_send_mail($tomail, $subject, $body, $header);
}

function contact_mail($email, $from_name, $subject, $body){
  $body = mb_convert_encoding($body, "ISO-2022-JP","AUTO");
  $tomail= 'hieu.hc@bellezavietnam.vn';
  $header  = "Return-Path: $email\n";
  $header .= "From:" . mb_encode_mimeheader($from_name) . "<$email>\n";
  $header .="MIME-Version: 1.0\r\nContent-Type: text/html; charset=ISO-2022-JP\r\n";
  $header .= "Reply-To: $email\n";
  return mb_send_mail($tomail,$subject ,$body, $header);
}
//================================================================================
// County list
//================================================================================
function county_list(){
  return $county_list = [
        '北海道',   '青森県',   '岩手県',   '宮城県',
        '秋田県',   '山形県',   '福島県',   '茨城県',   '栃木県',
        '群馬県',   '埼玉県',   '千葉県',   '東京都',   '神奈川県',
        '新潟県',   '富山県',   '石川県',   '福井県',   '山梨県',
        '長野県',   '岐阜県',   '静岡県',   '愛知県',   '三重県',
        '滋賀県',   '京都府',   '大阪府',   '兵庫県',   '奈良県',
        '和歌山県', '鳥取県',   '島根県',   '岡山県',   '広島県',
        '山口県',   '徳島県',   '香川県',   '愛媛県',   '高知県',
        '福岡県',   '佐賀県',   '長崎県',   '熊本県',   '大分県',
        '宮崎県',   '鹿児島県', '沖縄県'
    ];
  }

//================================================================================
// Job list
//================================================================================
function job_list(){
  return $job_list = [
        '公務員',   'コンサルタント',   'コンピューター関連技術職',   'コンピューター関連以外の技術職',
        '金融関係',   '医師',   '弁護士',   '総務・人事・事務',   '営業・販売',
        '研究・開発',   '広報・宣伝',   '企画・マーケティング',   'デザイン関係',   '会社経営・役員',
        '出版・マスコミ関係',   '学生・フリーター',   '主婦',   'その他'
    ];
  }

//================================================================================
// Limit words
//================================================================================
  function limitTextWords($content = false, $limit = false, $stripTags = false, $ellipsis = false)
{
    if ($content && $limit) {
        $content = ($stripTags ? strip_tags($content) : $content);
        $content = explode(' ', $content, $limit+1);
        array_pop($content);
        if ($ellipsis) {
            array_push($content, '。。。');
        }
        $content = implode(' ', $content);
    }
    return $content;
}

//================================================================================
// Limit characters
//================================================================================

function limitTextChars($content = false, $limit = false, $stripTags = false, $ellipsis = false)
{
    if ($content && $limit) {
        $content  = ($stripTags ? strip_tags($content) : $content);
        $ellipsis = ($ellipsis ? "。。。" : $ellipsis);
        $content  = mb_strimwidth($content, 0, $limit, $ellipsis);
    }
    return $content;
}
