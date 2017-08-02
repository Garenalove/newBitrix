<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<br>
    <!--Items-->
    <? foreach ($arResult as $item):?>

<div class="container">
        <div class="row">
            <h3><a href="<?=$item["VACANCY"]["URI"]?>"><?=$item["VACANCY"]["NAMES"]?></a></h3>
            <p>Пользователь: <?=$item["USER_EMAIL"]?> </p>
            <p>Сопроводительное письмо:</p>
            <p><?=$item["COVERING_LETTER"]?></p>
        </div>
</div>
    <? endforeach; ?>
