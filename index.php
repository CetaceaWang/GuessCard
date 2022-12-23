<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>菲奇切尼的五張牌花招-Fitch Cheney's Five Card Trick</TITLE>
		<META CONTENT="text/html; charset=UTF-8" HTTP-EQUIV="Content-Type">
	</HEAD>
	<BODY TOPMARGIN="0" LEFTMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onload="CacheImages()">
	<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD colspan="7" style="font-size:40px"><span style="font-size:40px" id="BlankCardSerial">請選擇第<span id="CardSerial">1</span>張卡片</span></TD>
	</TR>
	<TR>
		<TD><IMG id="1" SRC="images/1.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(1)" ></TD>
		<TD><IMG id="2" SRC="images/2.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(2)" ></TD>
		<TD><IMG id="3" SRC="images/3.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(3)"></TD>
		<TD><IMG id="4" SRC="images/4.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(4)"></TD>
    <TD><IMG id="5" SRC="images/5.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(5)"></TD>
		<TD><IMG id="6" SRC="images/6.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(6)"></TD>
		<TD><IMG id="7" SRC="images/7.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(7)"></TD>
		
	</TR>
  <TR>
  <TD><IMG id="8" SRC="images/8.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(8)"></TD> 
		<TD><IMG id="9" SRC="images/9.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(9)"></TD>
		<TD><IMG id="10" SRC="images/10.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(10)"></TD>
		<TD><IMG id="11" SRC="images/11.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(11)"></TD>
		<TD><IMG id="12" SRC="images/12.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(12)"></TD>
    <TD><IMG id="13" SRC="images/13.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(13)"></TD>
    <TD></TD>
	</TR>
  <TR>
		<TD><IMG id="400" SRC="images/400.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(400)"></TD>
		<TD><IMG id="300" SRC="images/300.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(300)"></TD>
		<TD><IMG id="200" SRC="images/200.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(200)"></TD>
		<TD><IMG id="100" SRC="images/100.png" WIDTH="128" BORDER="0" HEIGHT="128" onclick="SelectNumer(100)"></TD>
    <TD></TD>
    <TD></TD>
    <TD></TD>
	</TR>
</TABLE>
<div id="SelectedCards" style="font-size:40px">選擇的卡片：</div>
<div style="font-size:40px">
  <IMG id="SelectedCard1" SRC="images/0.png" WIDTH="128" BORDER="0" HEIGHT="128" onload="CheckComplete()">
  <IMG id="SelectedCard2" SRC="images/0.png" WIDTH="128" BORDER="0" HEIGHT="128" onload="CheckComplete()">
  <IMG id="SelectedCard3" SRC="images/0.png" WIDTH="128" BORDER="0" HEIGHT="128" onload="CheckComplete()">
  <IMG id="SelectedCard4" SRC="images/0.png" WIDTH="128" BORDER="0" HEIGHT="128" onload="CheckComplete()">
</div>
<div style="font-size:40px">答案：</div>
<div style="font-size:40px">
  <IMG id="AnswerCard" SRC="images/0.png" WIDTH="256" BORDER="0" HEIGHT="256" onclick="DisplayAnswer()">
</div>
<div id="Debug" style="font-size:40px"></div>
<div id="End" style="font-size:40px"><a href="javascript:window.location.reload(true)" >
    再來一次</a></div>
<div id="CacheImages" ></div>    
<div align="center"><a href="https://nelsonprogram.blogspot.com/2022/11/blog-post_5.html" target="_blank">
    >>意見反映<<</a>　　　訪客數：<?php echo counter(); ?></div>
</BODY>
</HTML>

<script type="text/javascript">
  let selectCards = new Array(0,0,0,0);
  let specialDiffer = new Array(0,0,0,0);
  let isIncrease=false; 
  let arraySerial=0;
  let selectOne=false;
  let firstSelect=0;
  let guessCard=100;
  function SelectNumer(id){
    if  (arraySerial==4) //選完了
      return;
    if (selectOne&&!IsValid(selectCards[arraySerial],id))
      {
      document.getElementById("Debug").innerHTML="選擇錯誤，請重新選擇";
      return;
      }
    else  
      document.getElementById("Debug").innerHTML="";
    if (!selectOne){  
      firstSelect=id;
      document.getElementById(id).style.opacity=0.3;
      }
    selectCards[arraySerial]=selectCards[arraySerial]+id;
    if (selectOne)
    {
      if (id<20)//先選花色
        specialDiffer[arraySerial]=1;
      document.getElementById(firstSelect).style.opacity=1;
      if (arraySerial==0 && id<20)//先選花色
        isIncrease=true;
      selectOne=false;
      arraySerial++;
      document.getElementById("SelectedCard"+arraySerial).src="images/"+selectCards[arraySerial-1]+".png";
      //DisplaySpecialDiffer();
    }
    else
      selectOne=true;
  }
  function CheckComplete(){
    if  (arraySerial<4)
        document.getElementById("CardSerial").innerHTML=arraySerial+1;
      else
        {
          document.getElementById("BlankCardSerial").innerHTML="選擇完畢";
          setTimeout(ArraySerial,500);//0.5秒後才執行
          //ArraySerial();
        }
  }
  function ArraySerial(){
    for (i=1;i<4;i++)
      if (IsBigger(selectCards[0],selectCards[i]))
        guessCard+=100;//花色
    let cardNumber=selectCards[0] % 100; //數字
    if (isIncrease)
      cardNumber+=DifferNumber();
    else
      cardNumber-=DifferNumber();
    if (cardNumber>13)
      cardNumber-=13;    
    if (cardNumber<0) 
      cardNumber+=13;
    guessCard+=cardNumber;
    document.getElementById("AnswerCard").src="images/500.png";
  }
  function DisplayAnswer(){
    document.getElementById("AnswerCard").src="images/"+guessCard+".png";
  }
  function DifferNumber(){
    if (SpecialDiffer())
      return 0;
    if (IsBigger(selectCards[1],selectCards[2]))
      if (IsBigger(selectCards[1],selectCards[3]))
        if (IsBigger(selectCards[2],selectCards[3]))
          return 6;
        else
          return 5;
      else
        return 3;     
    else
      if (IsBigger(selectCards[1],selectCards[3]))
        return 4;
      else
        if (IsBigger(selectCards[2],selectCards[3]))
          return 2;
        else
          return 1;
  }
  function SpecialDiffer(){
    if (specialDiffer[0]==1 && specialDiffer[1]==1 && specialDiffer[2]==0 && specialDiffer[3]==0)
      return true;
    else
      return false;
  }
  function IsBigger(a,b){
    let modA=a % 100;
    let modB=b % 100;
    if (modA>modB)
      return true;
    if (modA<modB)
      return false;
    if (a>=b)
      return true;
    else
      return false;  
  }
  function IsValid(a,b){
    if (a>90 && b>90)
      return false;
    if ((a>=b && a-b<20)||(a<b && b-a<20))
      return false;
    else
      return true;
  }
  function DisplaySpecialDiffer(){
    let debugText="";
    for (i=0;i<4;i++)
      debugText+=specialDiffer[i]+",";
    document.getElementById("Debug").innerHTML=debugText;
  }
  function CacheImages(){
    let cahcheImages="";
    for (i=1;i<5;i++)
      for (j=1;j<14;j++)
        cahcheImages+='<link rel="preload" href="images/'+(i*100+j)+'.png" as="image">';
    cahcheImages+='<link rel="preload" href="images/0.png" as="image">';
    cahcheImages+='<link rel="preload" href="images/500.png" as="image">';
    document.getElementById("CacheImages").innerHTML=cahcheImages;
  }
</script>
<?php
function counter()
{
	$filename="counter.dat";
	if (!file_exists($filename)) 
		touch($filename);	
	$counter = intval(file_get_contents($filename));
	if (!isset($_COOKIE['visitor'])) {
		$counter++;
		$fp = fopen($filename, "w");
		flock($fp, LOCK_EX);   // do an exclusive lock
		fwrite($fp, $counter);
		flock($fp, LOCK_UN);   // release the lock
		fclose($fp);
		setcookie("visitor", 1, time()+3600);
	}
	return $counter;
}
?>