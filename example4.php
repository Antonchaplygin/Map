<?php

header("Content-type: text/xml");

include("db_connect.php");


echo '<?xml version="1.0" encoding="utf-8"?>
<ymaps xmlns="http://maps.yandex.ru/ymaps/1.x" xmlns:gml="http://www.opengis.net/gml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://maps.yandex.ru/schemas/ymaps/1.x/ymaps.xsd">
    <Representation xmlns="http://maps.yandex.ru/representation/1.x">
        <Style gml:id="org">
            <iconStyle>
            <href>http://api-maps.yandex.ru/i/0.4/micro/pmrds.png</href>
                <size x="28" y="29"/>
                <offset x="14" y="-14"/>
            </iconStyle>

            <balloonContentStyle>
                <template>#balloonTemplate</template>
            </balloonContentStyle>
        </Style>

        <Template gml:id="balloonTemplate">
            <text><![CDATA[
			<div style="font-size:12px;">
                        <div style="color:#ff0303;font-weight:bold">$[name]</div>
                        <div>Адрес: $[metaDataProperty.AnyMetaData.adres|не задан]</div>
                        <div>Телефон: $[metaDataProperty.AnyMetaData.telefon|не задан]</div>
						<div>Тип: $[metaDataProperty.AnyMetaData.type|не задан]</div>
                    </div>]]></text>
        </Template>
    </Representation>

    <GeoObjectCollection>
        <gml:name>Объекты карте</gml:name>
        <style>#org</style>
        <gml:featureMembers>';

$query1= "SELECT * FROM objects limit 5";
$result1 = DB::query($query1);
while ($par1 = $result1->fetch_array())
{


echo '<GeoObject>';
echo '<gml:name>', htmlspecialchars($par1['name']), '</gml:name>';
echo '<gml:metaDataProperty>';
echo '<AnyMetaData>';
echo '<adres>', $par1['address'], '</adres>';
echo '<telefon>', $par1['phone'], '</telefon>';
echo '</AnyMetaData>';
echo '</gml:metaDataProperty>';
echo '<gml:Point>';
//echo '<gml:pos>', $par1['location']'</gml:pos>';
echo '<gml:pos>' .$par1['location']. '</gml:pos>';
//echo '<gml:pos>', $par1['XX'], ' ', $par1['YY'], '</gml:pos>';
echo '</gml:Point>';
echo '</GeoObject>';

//echo "n";

}

echo '</gml:featureMembers>
    </GeoObjectCollection>
</ymaps>';
