<?php include "menu.php" ?>

<h1>Новости</h1>

<h2>Все новости:</h2>
<?php foreach ($news as $item): ?>
    <a href="<?=route('news.NewsOne', $item['id'])?>"><?=$item['title']?></a><br>
<?php endforeach;?>

<h2>Новости по категориям:</h2>
<?php foreach ($categories as $item): ?>
    <a href="<?=route('news.NewsCategory', $item['slug'])?>"><?=$item['category_title']?></a><br>
<?php endforeach;?>

