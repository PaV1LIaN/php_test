function AttachDiskToPortal(&$arFields) {
    if ($arFields["IBLOCK_ID"] == IBLOCK_PORTALS_ID) {
        if (!\Bitrix\Main\Loader::includeModule('disk')) return;
        
        $element = CIBlockElement::GetByID($arFields["ID"])->Fetch();
        if (!empty($element["PROPERTY_DISK_STORAGE_VALUE"])) return;
        
        try {
            $storage = \Bitrix\Disk\Driver::getInstance()->addStorage([
                'NAME' => 'Портал: '.$arFields["NAME"],
                'ENTITY_TYPE' => \Bitrix\Disk\ProxyType\Common::className(),
                'ENTITY_ID' => 'portal_'.$arFields["ID"],
                'MODULE_ID' => 'iblock'
            ]);
            
            CIBlockElement::SetPropertyValuesEx(
                $arFields["ID"],
                $arFields["IBLOCK_ID"],
                ["DISK_STORAGE" => $storage->getId()]
            );
            
            // Создаем базовые папки
            $root = $storage->getRootObject();
            $folders = ['Документы', 'Шаблоны', 'Архив'];
            foreach ($folders as $folderName) {
                $root->addSubFolder(['NAME' => $folderName]);
            }
        } catch (\Exception $e) {
            AddMessage2Log("Ошибка создания диска: ".$e->getMessage(), 'portal_hub');
        }
    }
}