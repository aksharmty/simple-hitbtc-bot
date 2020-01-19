<html>
<head>
    <meta http-equiv="refresh" content="30; url=#" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Free Arbutrage scanner for hitbtc in DOGE-ETH-BTC</title>
<meta name="description" content="scan best arbitrage possibility in hitbtc for DOGE-ETH-BTC " />
</head>
//bid-ask DOGEbtc price
$url = "https://api.hitbtc.com/api/2/public/ticker/DOGEBTC";
$dataDOGEBTC = json_decode(file_get_contents($url), true);
$symbol=$dataDOGEBTC['symbol'];
$bid=$dataDOGEBTC['bid'];
$ask=$dataDOGEBTC['ask'];

//bid-ask DOGEeth price
$url1 = "https://api.hitbtc.com/api/2/public/ticker/DOGEETH";
$dataDOGEETH = json_decode(file_get_contents($url1), true);
$symbol1=$dataDOGEETH['symbol'];
$bid1=$dataDOGEETH['bid'];
$ask1=$dataDOGEETH['ask'];

//bid-ask dogeeth price
$url2 = "https://api.hitbtc.com/api/2/public/ticker/ETHBTC";
$dataETHBTC = json_decode(file_get_contents($url2), true);
$symbol2=$dataETHBTC['symbol'];
$bid2=$dataETHBTC['bid'];
$ask2=$dataETHBTC['ask'];
?>
<center>This arbitrage bot work only for DOGEBTC-DOGEETH-ETHBTC ON Hitbtc<br>
This page refrash every 30 second and try to find profit if find profit more then 0.3% then place one order in each market.<br>
You can also use cron for auto refrash in backgroud on cloud.<br>
Default DOGE quantity 20. If have more doge you can replace quantity as per your need.<br> 
<table><tr><td width="30%"><h3>
<?php
echo "symbol : "; echo $symbol; echo "<br>";
echo "DOGEbtc bid : "; echo $bid; echo "<br>"; 
echo "DOGEbtc ask :"; echo  $ask; echo "<br>";
?></h3>
</td><td width="30%"><h3>
<?php
echo "symbol : "; echo $symbol1; echo "<br>";
echo "DOGEeth bid : "; echo $bid1; echo "<br>"; 
echo "DOGEeth ask :"; echo  $ask1; echo "<br>";
?></h3>
</td><td width="30%"><h3>
<?php
echo "symbol : "; echo $symbol2; echo "<br>";
echo "ethbtc bid : "; echo $bid2; echo "<br>"; 
echo "ethbtc ask :"; echo  $ask2; echo "<br>";
?></h3></td></tr></table>
<h2>calculate now </h2><br>
<table><tr><td width="50%"> column1<br>
DOGEBTC -- DOGEETH -- ETHBTC <br><font size="4px">
buy 20 DOGE on ask <?php $a=$ask*20; ?><?php $a1=number_format($a,11); echo "from dogebtc "; echo $a1; ?> <br>
<font color="red">
    <?php $dogebtc=$a1*7/10000; $dogebtc1=number_format($dogebtc,11); $dogebtc2=$a1+$dogebtc1; $dogebtc3=number_format($dogebtc2,11); echo "fee "; echo $dogebtc1; echo " btc spend "; echo $dogebtc3; ?> BTC<br></font>
sell 20 DOGE on bid <?php $b=$bid1*20; ?><?php $b1=number_format($b,9); echo "ETHDOGE after sell "; echo $b1; ?> ETH <br>
<font color="red">
    <?php $beth=$b1*7/10000; $beth1=number_format($beth,8); $beth2=$b1-$beth1; $beth3=number_format($beth2,8); echo "fee "; echo $beth1; echo " Received "; echo $beth3; ?> ETH<br></font>
sell ETH on bid <?php $c=$beth3*$bid2; ?><?php $c1=number_format($c,11); echo "ETHBTC after sell "; echo $c1; ?> BTC<br>
<font color="red">
    <?php $ethbtc=$c1*7/10000; $ethbtc1=number_format($ethbtc,9); $ethbtc2=$c1-$ethbtc1; $ethbtc3=number_format($ethbtc2,8); echo "fee "; echo $ethbtc1; echo " Received "; echo $ethbtc3; ?> BTC<br></font>
<font color="blue">
    <?php $d=$ethbtc3-$dogebtc3; ?><?php $d1=number_format($d,11); echo "total profit with fee  "; echo $d1; ?> BTC <br>
<?php //$p0=$a1/100; $p01=$d1/$p0; 
$p0=$dogebtc3/100; $p01=$d1/$p0; echo "profit in % " ; echo $p01; ?>% BTC</font><br>
<H3>Result for equation</H3><br>
<?php
$output=$p01;
if ($output >= 0.3) {
echo "<B>buy DOGEBTC -- DOGEETH -- ETHBTC</B>" ; echo"<br><br>";
echo "<B>buy 20 DOGE in BTC at </B>" ; echo "<b>";echo $ask; echo " ask price</b>"; echo"<br>";
echo "<B>sell 20 DOGE in ETH at </B>" ; echo "<b>";echo $bid1; echo " bid price</b>"; echo"<br>";
echo "<B>sell "; echo $b1 ; echo " ETH in BTC at </B>" ; echo "<b>";echo $bid2; echo " bid price </b>"; echo"<br>";
//DOGEBTC BUY
$symbol = DOGEBTC;
$side = buy;
$type = limit;
$price=$ask;
$quantity=20;
$timeInForce= GTC; 
$ch = curl_init();
//do a post
curl_setopt($ch,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch, CURLOPT_USERPWD, 'API_KEY:SECRET_KEY'); // API AND KEY 
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"symbol=$symbol&side=$side&price=$price&quantity=$quantity&type=$type&timeInForce=$timeInForce");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result);
echo"<pre>";
print_r($result);
//order end


//sell DOGEETH

$symbol1 = DOGEETH;
$side1 = sell;
$type1 = limit;
$price1=$bid1;
$quantity1=20;
$timeInForce1= GTC; 

$ch1 = curl_init();
//do a post
curl_setopt($ch1,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch1, CURLOPT_USERPWD, 'API_KEY:SECRET_KEY'); // API AND KEY 
curl_setopt($ch1, CURLOPT_POST,1);
curl_setopt($ch1,CURLOPT_POSTFIELDS,"symbol=$symbol1&side=$side1&price=$price1&quantity=$quantity1&type=$type1&timeInForce=$timeInForce1");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('accept: application/json'));
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
$result1=curl_exec($ch1);
curl_close($ch1);
$result1=json_decode($result1);
echo"<pre>";
print_r($result1);
//order end


//sell ETHBTC

$symbol2 = ETHBTC;
$side2 = sell;
$type2 = limit;
$price2=$bid2;
$quantity2=$beth3;
$timeInForce2= GTC; 
$ch2 = curl_init();
//do a post
curl_setopt($ch2,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch2, CURLOPT_USERPWD, 'API_KEY:SECRET_KEY'); // API AND KEY 
curl_setopt($ch2, CURLOPT_POST,1);
curl_setopt($ch2,CURLOPT_POSTFIELDS,"symbol=$symbol2&side=$side2&price=$price2&quantity=$quantity2&type=$type2&timeInForce=$timeInForce2");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('accept: application/json'));
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
$result2=curl_exec($ch2);
curl_close($ch2);
$result2=json_decode($result2);
echo"<pre>";
print_r($result2);
//order end

  }
else // +
{
    echo "<B>NO Arbitrage Match <br> FOR DOGEBTC -- DOGEETH -- ETHBTC</B>"; echo"<br>";
 
}
// end DOGEBTC -- DOGEETH -- ETHBTC code
?>
<br><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- achhey -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-4305348743992957"
     data-ad-slot="3135886125"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</td></tr></table>
</center>
