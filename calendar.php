<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        table{
            border-collapse: collapse;
        }
        table td{
            border:1px solid #ccc;
            padding:3px 9px;
        }
        .cal{
            display:flex;
            flex-wrap: wrap;
            width:80%;
            margin: auto;
        }
        .cal .date{
            border:1px solid #999;
            width:calc(100% / 7);
            margin-left:-1px;
            margin-top:-1px;
        }
        .cal .date:hover{
            transform: scale(1.05);
            background-color: lightcyan;
        }
        .holiday{
            background-color: pink;
        }
    </style>
</head>
<body>
<?php
$cal=[];
$holiday=['2022-10-25'=>"光復節","2022-10-10"=>"國慶日"];
$month=(isset($_GET['m']))?$_GET['m']:date("n");
$year=(isset($_GET['y']))?$_GET['y']:date("Y");

$nextMonth=$month+1;
$prevMonth=$month-1;


$firstDay=$year."-".$month."-1";
$firstDayWeek=date("N",strtotime($firstDay));
$monthDays=date("t",strtotime($firstDay));
$lastDay=$year.'-'.$month.'-'.$monthDays;
$spaceDays=$firstDayWeek-1;
$weeks=ceil(($monthDays+$spaceDays)/7);

for($i=0;$i<$spaceDays;$i++){
    $cal[]='';
}

for($i=0;$i<$monthDays;$i++){
    $cal[]=date("Y-m-d",strtotime("+$i days",strtotime($firstDay)));
}

/* echo "<pre>";
print_r($cal);
echo "</pre>"; */

echo "第一天".$firstDay."星期".$firstDayWeek;
echo "<br>";
echo "該月共".$monthDays."天,最後一天是".$lastDay;
echo "<br>";
echo "月曆天數共".($monthDays+$spaceDays)."天，".$weeks."周";

?>

<div style="display:flex;width:80%;justify-content:space-between;align-items:center">
    <a href="?y=2022&m=<?=$prevMonth;?>">上一個月</a>
    <h1><?=$year;?> 年 <?=$month;?> 月份</h1>
    <a href="?y=2022&m=<?=$nextMonth;?>">下一個月</a>
</div>

<div class='cal'>
<?php
foreach($cal as $i => $day){
    if($day!=""){
        $show=explode("-",$day)[2];
    }else{
        $show="";
    }
    
    if(array_key_exists($day,$holiday)){

        echo "<div class='date holiday'>";
        echo $show;
        echo "<div>{$holiday[$day]}</div>";
        echo "</div>";
    }else{

        echo "<div class='date'>$show</div>";
    }
}
?>
</div>

</body>
</html>