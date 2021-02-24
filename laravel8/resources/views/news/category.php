<?php include "menu.php" ?>

<h1>Новости</h1>

<h2>Новости в категории: <?=$category_title ?></h2>
<?php foreach ($news as $item): ?>
    <a href="<?=route('news.NewsOne', $item['id'])?>"><?=$item['title']?></a><br>
<?php endforeach;?>
