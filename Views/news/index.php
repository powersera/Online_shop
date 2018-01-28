<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        <?php require_once ROOT.'/templates/css/News.css';?>

    </style>
</head>
<body>

<div id = Wrapper>
    <?php foreach ($NewsList as $NewsItem):?>
    <div class = title>
        <?php echo $NewsItem['title'];?>

    </div>
        <div class = post>
            <?= $NewsItem['comment'];?>
        </div>
    <div class = "link">
        <a href="/news/<?= $NewsItem['id'];?>">Read more</a>

    </div>
    <?php endforeach;?>

</div>


</body>
</html>