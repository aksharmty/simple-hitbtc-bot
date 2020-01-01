<?php
$url = "https://api.hitbtc.com/api/2/public/ticker/DOGEBTC";
$dataDOGEBTC = json_decode(file_get_contents($url), true);
$symbol=$dataDOGEBTC['symbol'];
$bid=$dataDOGEBTC['bid'];
$ask=$dataDOGEBTC['ask'];
?>
//<? $price=$bid-0.00000000050;?>
<? $price=$ask;?>
<?php
$awb = "$price";
$awb1=number_format($awb,10);
?>
//<? $price1=$bid+0.00000000150;?>
<?$ask06=$ask*0.6/100;
$price1=$ask+$ask06;?>
<?php
$awb2 = "$price1";
$awb3=number_format($awb2,10);
?>
********
<?php
$symbol   = DOGEBTC;
$side = buy;
$type = limit;
$price= $awb1;
$quantity=10;
$timeInForce= GTC; // GET EMAIL INTO VAR

$ch = curl_init();
//do a post
curl_setopt($ch,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch, CURLOPT_USERPWD, ' yourhitbtc api key : your hitbtc secret key '); // API AND KEY
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"symbol=$symbol&side=$side&price=$price&quantity=$quantity&type=$type&timeInForce=$timeInForce");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result);
echo"<pre>";
print_r($result); 
?>
<?php
$symbol1   = DOGEBTC;
$side1= sell;
$type1= limit;
$price1= $awb3;
$quantity1=10;
$timeInForce1= GTC;

$ch1 = curl_init();
//do a post
curl_setopt($ch1,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch1, CURLOPT_USERPWD, ' yourhitbtc api key : your hitbtc secret key '); // API AND KEY
curl_setopt($ch1, CURLOPT_POST,1);
curl_setopt($ch1,CURLOPT_POSTFIELDS,"symbol=$symbol1&side=$side1&price=$price1&quantity=$quantity1&type=$type1&timeInForce=$timeInForce1");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('accept: application/json'));
$result1=curl_exec($ch1);
curl_close($ch1);
$result1=json_decode($result1);
echo"<pre>";
print_r($result1); 
?>
