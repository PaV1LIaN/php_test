<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin.php');

if ($USER->IsAdmin()) {
    $iblockId = 12; // ID вашего инфоблока
    
    $el = new CIBlockElement;
    
    $portalData = [
        "NAME" => "Новый маркетплейс",
        "IBLOCK_ID" => $iblockId,
        "PREVIEW_TEXT" => "Внутренняя система управления маркетплейсами",
        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].'/local/images/marketplace-logo.png'),
        "PROPERTY_VALUES" => [
            "URL" => "https://marketplace.company.com",
            "CATEGORY" => "Продажи"
        ]
    ];
    
    if ($portalId = $el->Add($portalData)) {
        echo "Портал успешно добавлен (ID: ".$portalId.")";
    } else {
        echo "Ошибка: ".$el->LAST_ERROR;
    }
} else {
    echo "Доступ запрещен";
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');