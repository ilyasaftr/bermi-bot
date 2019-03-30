<?php
set_time_limit(0);
error_reporting(0);
echo '####################################';
echo "\r\n";
echo '# Copyright : @ilyasa48 | SGB-Team #';
echo "\r\n";
echo '####################################';
echo "\r\n";
echo 'Masukkan Email : '; 
$email = trim(fgets(STDIN)); 
echo 'Masukkan Password : '; 
$password = trim(fgets(STDIN)); 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.bermi.tv/login_user');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
    "email": "'.$email.'",
    "password": "'.$password.'"
}');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: api.bermi.tv';
$headers[] = 'Accept-Language: en-ID';
$headers[] = 'User-Agent: Android/5.1.1; Bermi/1.39.0; Manufacturer/samsung; Model/SM-N9005; Gaoiscoolman';
$headers[] = 'X-Connmac: tQ35321112767649263652273315975159842603915207';
$headers[] = 'Content-Type: application/json; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$json_data = json_decode($result);
if(preg_match('/"status": true/', $result)){
    echo "Berhasil Login";
    echo "\r\n";
}else if(preg_match('/"status": false/', $result)){
    die(json_encode(array('result' => 0, 'content' => ''.$json_data->error->errMsg.'')));
}else{
    die(json_encode(array('result' => 0, 'content' => 'Terjadi Kesalahan [1:2]')));
}
echo "\r\n";
echo "\r\n";
$user_hash = $json_data->data->user_hash;

$i = 0;
$x = 0;
while ($i <= 10) {

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.bermi.tv/lucky_draw');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user_hash=$user_hash");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: api.bermi.tv';
$headers[] = 'Cookie: user_hash=2|1:0|10:1553886053|9:user_hash|48:Y2U0c3pnZzgtZTZmZi00OGFiLWEyYjYteTRpbTNoNzg1Nzcx|197603b589e3ff9bd777683a9211c1184c84a1b3a3fcf7c085c7b00d6b6c4a5d';
$headers[] = 'Accept-Language: en-ID';
$headers[] = 'User-Agent: Android/5.1.1; Bermi/1.39.0; Manufacturer/samsung; Model/SM-N9005; Gaoiscoolman';
$headers[] = 'X-Connmac: H8UF631108971360547655389742947256837109946440';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$json_data = json_decode($result);
$x++;
if(preg_match('/"status": true/', $result)){
	echo "[$x] Berhasil\r\n[$x] Berm Token : ".$json_data->data->berm_token."\r\n[$x] USD : ".$json_data->data->usd."\r\n[$x] Lucky Draw : +".$json_data->data->lucky_draw." USD";
    echo "\r\n";
}else if(preg_match('/"status": false/', $result)){
	echo "[$x] ".$json_data->error->errMsg;
    echo "\r\n";
	exit();
}else{
	echo "[$x] Terjadi Kesalahan";
    echo "\r\n";
	exit();
}
}