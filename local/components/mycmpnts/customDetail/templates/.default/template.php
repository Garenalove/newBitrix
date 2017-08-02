<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class = "main" id = "<?=$arResult["VACANCY"]["ID"]?>">
<h3><?=$arResult["VACANCY"]["name"]?></h3>
<p>Зарплата от: <?=$arResult["VACANCY"]["payment"]?> </p>
<p>Зарплата до: <?=$arResult["VACANCY"]["payment_up_to"]?> </p>
<p>Специализация: <?=$arResult["VACANCY"]["spec"]?></p>
<p>Работодатель: <?=$arResult["VACANCY"]['employer']['name']?></p>
<a href="<?=$arResult["VACANCY"]["test"]?>" download>Тестовое задание</a>
</div>
<?if($arResult["BUTTON"] === "Y"):?>
    <button id='responseVacancy'>Откликнуться</button>
<?elseif($arResult["BUTTON"] === "N"):?>
    <button id='responseVacancy' disabled>Вы уже откликнулись</button>
<?endif;?>
<div class = "response"></div>
<!--Form-->
<div id="dialog-form" title="Отклик">
  <p class="validateTips">Сопроводительное письмо</p>
  <p class="exceptions"></p>
  <form id = "responseForm" action = '<?=$componentPath?>/response.php'>
    <fieldset>
        <textarea name="" rows="17"></textarea>
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

