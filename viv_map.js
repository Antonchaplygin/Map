ymaps.ready(init);

function init () {

    // Создание экземпляра карты.
    var myMap = new ymaps.Map('map', {
        center: [59.938630012065703,30.31413008841648],
        zoom: 12,
        controls: []
    });
   myMap.controls.add('smallZoomControl');
    // Загрузка YMapsML-файла.

    ymaps.geoXml.load('http://fortg.xyz/www/public_html2/example4.php')

        .then(function (res) {
            /*res.geoObjects.each(function (item) {
               //addMenuItem(item, myMap);
               console.log(item)
                myMap.geoObjects.add(item.geoObjects);
                if (item.mapState) {
            item.mapState.applyToMap(myMap);

          }*/ console.log(res)
          myMap.geoObjects.add(res.geoObjects);
          if (res.mapState) {
          res.mapState.applyToMap(myMap);
        }//);
        },



        // Вызывается в случае неудачной загрузки YMapsML-файла.
        function (error) {
          console.log(error);
            alert("При загрузке YMapsML-файла произошла ошибка: " + error);
        });

    // Добавление элемента в список.
    /*
     function addMenuItem(group, map) {
        // Показать/скрыть группу геообъектов на карте.
        $("<a class=\"title\" href=\"#\">" + group.properties.get('name') + "</a>")
            .bind("click", function () {
                var link = $(this);
                // Если пункт меню "неактивный", то добавляем группу на карту,
                // иначе - удаляем с карты.
                if (link.hasClass("active")) {
                    map.geoObjects.remove(group);
                } else {
                    map.geoObjects.add(group);
                }
                // Меняем "активность" пункта меню.
                link.toggleClass("active");
                return false;
            })
            // Добавление нового пункта меню в список.
            .appendTo(
                $("<li></li>").appendTo($("#menu"))
            );
    }
   */
}
