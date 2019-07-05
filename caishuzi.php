<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>猜数字游戏</title>
</head>
<body>
    <?php
        if(isset($_GET["again"])){
            echo "<script> document.location \"caishuzi.php\"</script>";
            unset($_POST["submit"]);
        }

        $answer = @$_POST["answer"];
        $times = @$_POST["times"];
        if(isset($_POST["submit"]) && !empty($_POST["num"])){
            $num = $_POST["num"];
            if($num==$answer && $times>=1){
                $used_times = 4 - $times;
                $info = "太棒了，你只用了{$used_times}次机会！</br></br> <a href=\"?again = ture\">再玩一次戳我</a>";
                $submit_status = 'disabled="disabled"';
            }elseif($times>=1){
                // $num > $answer ? $info = "猜大了，你还有".($times)."次机会！":$info = "不正确，三次机会都用完了！<a href=\"?again = ture\">再玩一次戳我</a>";
                if($num > $answer)//或者用上面的三目运算符进行运算
                    $info = "猜大了，你还有".($times-1)."次机会！";
                else
                    $info = "猜小了，你还有".($times-1)."次机会！";
            }else{
                $submit_status = 'disabled="disabled"';
                $info = "不正确，三次机会都用完了！</br></br> 正确答案是".($answer)." </br></br> <a href=\"?again = ture\">再玩一次戳我</a>";
            }
            $times--;
        }elseif(isset($_POST["submit"]) && empty($_POST["num"])){
            $info = "请输入整数（1-10），你还有3次机会！";
        }else{
            $answer = rand(1,10);
            $times = 3;
        }
    ?>
    <h3>猜数字游戏</h3>
    <form action="" method="post">
        <p>请输入整数（1-10），共三次机会：</p>
        <input type="text" name="num" value="<?php echo @$num; ?>">
        <input type="submit" name="submit" value="确定" <?php echo @$submit_status; ?>>
        <input type="hidden" name="answer" value="<?php echo @$answer; ?>">
        <input type="hidden" name="times" value="<?php echo @$times; ?>">
    </form>
        <p><?=@$info?></p>
</body>
</html>