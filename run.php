<?php
// Ilyasa Fathur Rahman
// SGB-Team Reborn
set_time_limit(0);
error_reporting(0);
echo '####################################';
echo "\r\n";
echo '# Copyright : @ilyasa48 | SGB-Team #';
echo "\r\n";
echo '####################################';
echo "\r\n";
echo 'Masukkan Kode Referral (bfa9ec04) : '; 
$code = trim(fgets(STDIN)); 
echo 'Masukkan Jumlah : '; 
$jumlah = trim(fgets(STDIN)); 
$i=1;
while($i <= $jumlah){
echo "\r\n";
echo "[$i] [".date('h:i:s')."] Mendaftar-kan Akun dan Mendapat-kan User Hash...";
echo "\r\n";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://froidcode.com/api/bermi/register.php?create=yes");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$register = json_decode($result);

if($register->result == 1){
    echo "[$i] [".date('h:i:s')."] Berhasil, User Hash : ".$register->content."";
    echo "\r\n";
}else if($register->result == 0){
    echo "[$i] [".date('h:i:s')."] Gagal, ".$register->content."";
    echo "\r\n";
    exit();
}else{
    echo "[$i] [".date('h:i:s')."] Terjadi masalah dengan API FroidCode!";
    echo "\r\n";
    exit();
}

$user_hash = $register->content;
echo "[$i] [".date('h:i:s')."] Menginput Kode Referral dan Melakukan Beberapa Aktivitas...";
echo "\r\n";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://froidcode.com/api/bermi/finish.php?user_hash=$user_hash&referral=$code");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$finish = json_decode($result);

if($finish->result == 1){
    echo "[$i] [".date('h:i:s')."] ".$finish->content."";
    echo "\r\n";
}else if($finish->result == 0){
    echo "[$i] [".date('h:i:s')."] Gagal, ".$finish->content."";
    echo "\r\n";
    exit();
}else{
    echo "[$i] [".date('h:i:s')."] Terjadi masalah dengan API FroidCode!";
    echo "\r\n";
    exit();
}
$i++;
}