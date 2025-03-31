<?
function getPortalsList() {
    $portals = [];
    $iblockId = 12; // ID вашего инфоблока с порталами
    
    $res = CIBlockElement::GetList(
        ["SORT" => "ASC"],
        ["IBLOCK_ID" => $iblockId, "ACTIVE" => "Y"],
        false,
        false,
        ["ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_URL", "PROPERTY_CATEGORY"]
    );
    
    while($item = $res->GetNext()) {
        $portal = [
            'ID' => $item['ID'],
            'NAME' => $item['NAME'],
            'DESCRIPTION' => $item['PREVIEW_TEXT'],
            'URL' => $item['PROPERTY_URL_VALUE'],
            'CATEGORY' => $item['PROPERTY_CATEGORY_VALUE']
        ];
        
        if($item['DETAIL_PICTURE']) {
            $portal['LOGO'] = CFile::GetPath($item['DETAIL_PICTURE']);
        }
        
        $portals[] = $portal;
    }
    
    return $portals;
}