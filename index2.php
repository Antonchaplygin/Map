<?php

  session_start();

  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);
  require "db_connect.php";

  $map_height = DB::query("SELECT * FROM settings WHERE name='map-height'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>FAMILYonMAP | Помощь детям</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="/css/btp/bootstrap.min.css" rel="stylesheet">

  <!--<script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=3a856e2d-c768-418c-8082-e7688f6c512a" type="text/javascript"></script>-->
  <script src="https://api-maps.yandex.ru/2.0/?load=package.map,package.controls,package.geoXml&lang=ru-RU&amp;apikey=3a856e2d-c768-418c-8082-e7688f6c512a" type="text/javascript"></script>

  <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
  <script src="viv_map.js" type="text/javascript"></script>



  <!-- jQuery library - Please load it from Google API's -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- jQuery UI Widget and Effects Core (custom download)
     You can make your own at: http://jqueryui.com/download -->
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<!-- Latest version (3.0.6) of jQuery Mouse Wheel by Brandon Aaron
     You will find it here: http://brandonaaron.net/code/mousewheel/demos -->
<script src="js/jquery.mousewheel.min.js"></script>
<!-- jQuery Kinectic (1.5) used for touch scrolling -->
<script src="js/jquery.kinetic.min.js"></script>
<!-- Smooth Div Scroll 1.3 minified-->
<script src="js/jquery.smoothdivscroll-1.3-min.js"></script>
<!-- Plugin initialization -->
<script>
   $(document).ready(function () {
     $("#logoParade").smoothDivScroll({
       autoScrollingMode: "always",
       autoScrollingDirection: "endlessLoopRight",
       autoScrollingStep: 1,
       autoScrollingInterval: 25
     });
     // Logo parade
     $("#logoParade").bind("mouseover", function () {
       $(this).smoothDivScroll("stopAutoScrolling");
     }).bind("mouseout", function () {
       $(this).smoothDivScroll("startAutoScrolling");
     });
   });
</script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="js/btp/bootstrap.min.js" type="text/javascript"></script>

  <link href="css/main.css" rel="stylesheet">
  <link href="css/preload.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://vk.com/js/api/openapi.js?150" type="text/javascript"></script>

  <script type="text/javascript">
  var loaded_map_height = <?php echo json_encode($map_height['value']); ?>;
  </script>

  <script src="js/on.js"></script>


<script>
// Place DB vars here
</script>

</head>
<body>

  <?php require_once 'navbar.php'; ?>

  <div id="header-slide">
    <div class="background_filter">
      <div id="header-main" class="slide-header center-block">
        <h1 class="h1_main"><span class="txt-red">Откройте </span><span class="txt-orange">город </span><span class="txt-green">для </span><span class="txt-purple">семьи</span><br><small class="txt-darkred">Находите и делитесь интересными предложениями и скидками в местах, куда можно сходить всей семьей</small></h1>
        <div class="form_main">
          <form class="form-inline justify-content-center" role="search" method="get" action="map.php">
            <div class="form-group">
              <input type="text" class="form-control" name="q" id="header-search-input" placeholder="Что вы ищете?">
              <button type="submit" class="btn btn-warning">Найти</button>
            </div>
          </form>
        </div>
        <button class="btn btn-danger btn-add" data-toggle="modal" data-target="#add-modal">Добавь точку на карту</button>
        <div class="container header-blocks">
          <div class="row justify-content-center">
            <?php

            $blocks_db = DB::query("SELECT * FROM category WHERE relate = 0");
            while($block = $blocks_db->fetch_assoc()){
              ?>
              <!-- <div class="col-sm justify-content-center">

                	<a href="/map.php?cat=<?php echo $block['id']; ?>" style="text-decoration: none;">
                  	  	<div class="rounded clr-block" style="background-color: <?php echo $block['color'];?>;">
                  	  	</div>
                  	  	<div class="clr-block-content">
	                        <img class="block-icon" src="<?php echo $block['icon']; ?>">
	                        <p><?php
	                          $qty = DB::query("SELECT COUNT(id) FROM objects WHERE category IN (SELECT id FROM category WHERE relate = '".$block['id']."') AND pending = 0")->fetch_assoc();
	                          echo $block['name']."&nbsp;(".$qty['COUNT(id)'].")";
	                         ?>
	                       </p>
                      </div>
                    </a>
                </div>-->

            <div class="col-sm justify-content-center">

                	<a href="/map.php?cat=<?php echo $block['id']; ?>" style="text-decoration: none;">
                  	  	<div class="rounded clr-block clr-<?php echo $block['color'];?>-transp");">
                  	  	    <img class="block-icon" src="<?php echo $block['icon']; ?>">
	                        <p><?php
	                          $qty = DB::query("SELECT COUNT(id) FROM objects WHERE category IN (SELECT id FROM category WHERE relate = '".$block['id']."') AND pending = 0")->fetch_assoc();
	                          echo $block['name']."&nbsp;(".$qty['COUNT(id)'].")";
	                         ?>
	                       </p>
                      </div>
                    </a>
                </div>


              <?php
            }

            ?>

          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="vk-slide">
    <div class="container">
      <div class="grid">
        <div class="grid__col-half grid__breaks-on-600">
          <div id="vk_groups">
          </div>
          <script type="text/javascript">
              VK.Widgets.Group("vk_groups", {mode: 2, width: "auto", height: "400", color3: '4182c3'}, 142801474);
          </script>
        </div>

        <div class="grid__col-half grid__breaks-on-600 grid__breaks-on-600-noheight">
			<a href="https://petrod.ru/" target="_blank"><img src="img/banner_petrod_515x400.gif" alt="Banner" style="width:100%">
			</a>
          <!--<img class="mySlides" src="img/banner-400x515.jpg" alt="Banner" style="width:100%">
          <img class="mySlides" src="img/banner-400x515_.jpg" alt="Banner" style="width:100%">-->
        </div>
      </div>
    </div>
  </div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

<!--
<div id="vk-slide">
    <div class="container">
      <div class="split left">
        <div id="vk_groups">
        </div>
          <script type="text/javascript">
              VK.Widgets.Group("vk_groups", {mode: 2, width: "auto", height: "400", color3: '4182c3'}, 142801474);
          </script>
      </div>

      <div class="split right">
          <img src="img_avatar2.png" alt="Avatar woman">
      </div>
    </div>
</div>
-->
<!--
  <div id="vk-slide">
    <div class="container">
      <div id="vk_groups"></div>
    </div>
    <script type="text/javascript">
    VK.Widgets.Group("vk_groups", {mode: 2, width: "auto", height: "400", color3: '4182c3'}, 142801474);
    </script>
  </div>
-->

 <div id="map" style="width:1470px;height:550px"></div>

  </div>

<style type="text/css">
		.partners-block__row
		{
    	padding: 45px 65px;
		}

		#logoParade
		{
			width: auto;
			height: auto;
			position: relative;
		}

		.scrollableArea #logoParade a
		{
			display: block;
			float: left;
			padding-left: 30px;
                        padding-right: 30px;
		}
</style>


<div class="partners-block__row" style="border-top: 1px solid #afafaf;">
	<div class="scrollingHotSpotLeft" style="display: none;">
	</div>
	<div class="scrollingHotSpotRight" style="display: none;">
	</div>
	<div class="scrollWrapper">
		<div class="scrollableArea">
			<div id="logoParade">
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
					<a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>
			</div>
		</div>
	</div>
</div>

  <div id="howto-slide">
    <div class="background_filter">
      <div class="slide-header"><h1><span class="txt-red">Как </span><span class="txt-orange">это </span><span class="txt-green">работает </span></h1></div>
      <div class="container text-centered"><img class="img-howto" src="/img/steps.png"></div>
    </div>
  </div>

  <div id="mission-slide">
    <div class="slide-header"><h1><span class="txt-purple">Миссия</span> <span class="txt-red">F</span><span class="txt-orange">A</span><span class="txt-green">M</span><span class="txt-sky">I</span><span class="txt-blue">L</span><span class="txt-purple">Y</span><span class="txt-red">ON</span><span class="txt-green">MAP</span></h1></div>


    <div class="container">
      <div class="row">
        <div class="text-centered col-md-3 col-xs-3">
          <img src="img/Family.png">
        </div>
        <div class="col-md-8 col-md-offset-3">
          <p class="txt-blue" style="font-family: 'Source Sans Pro'; font-weight: 700">Мы стремимся стать удобным и современным сервисом поиска мест, товаров и услуг для семейного досуга ВСЕХ семей и всестороннего развития ВСЕХ детей во ВСЕХ городах нашей страны</p>
        </div>
        <div class="col-md-1 d-none d-md-block">
          <img src="/img/eye.png">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-4">
          <div class="col-centered box img-rounded header-blocks shaded text-centered">
            <img class="mission-imgs" src="img/find.png">
            <p class="no-margin txt-green">НАХОДИ</p>
          </div>
        </div>
        <div class="col-4">
          <div class="col-centered box img-rounded header-blocks shaded text-centered">
            <img class="mission-imgs" src="img/add.png">
            <p class="no-margin txt-sky">ДОБАВЛЯЙ</p>
          </div>
        </div>
        <div class="col-4">
          <div class="col-centered box img-rounded header-blocks shaded text-centered">
            <img class="mission-imgs" src="img/learn.png">
            <p class="no-margin txt-purple">УЗНАВАЙ</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about-slide">
    <div class="slide-header"><h1 class="txt-green"><span class="txt-orange">О</span> нас</h1></div>
    <div class="container review">
      <div class="row">
        <div class="col-md-3 col-12 order-">
          <img src="img/irina.jpg">
          <p class="txt-blue">Апухтина Ирина</p>
        </div>
        <div class="col-md-8 col-md-offset-1 col-12">
          <p class="txt-purple" style="font-family: 'Source Sans Pro'; font-weight: 700">Мама трех мальчиков. У меня мало времени и огромное желание дать детям многое для их
  культурного и спортивного развития!
  Я начала искать информацию, и стала реже звонить и все чаще начала обращаться к Сети для
  удовлетворения своих поисковых запросов. Информация о льготах для многодетных семей,
  предоставляемых государством на федеральном и региональном уровнях разрознена в сети
  интернет.
  Однажды поняв, что я хочу получить всю необходимую информацию о представляемых
  льготах в одном месте, появилась идея создать сайт, который позволит показать все льготы
  интерактивно на карте нашего города.</p>
        </div>
      </div>
    </div><br>
    <div class="container review">
      <div class="row">
        <div class="col-md-3 col-md-offset-1 order-md-2 col-12">
          <img src="img/tatiana.jpg">
          <p class="txt-blue">Комарова Татьяна</p>
        </div>
        <div class="col-md-8 col-12">
          <p class="txt-purple" style="font-family: 'Source Sans Pro'; font-weight: 700">Мама двойняшек - Маши и Славы (особого ребенка), логопед.
  Если заглянуть в мой личный инстаграм @tanyaoppi, то станет понятно, что мы с детьми
  не сидим на месте! Несмотря на то, что у меня двое детей и я не на 100% мобильна, и порой,
  сложно потому, что Слава не видит практически, я стараюсь показать им обоим многообразие
  этого удивительного мира.
  Такие «подарки судьбы» случаются неожиданно, когда ты их совсем не ждешь. Я благодарна,
  что жизнь протягивает руку помощи - близкие и незнакомые люди не остаются безучастливыми
  и ты понимаешь, что доброта спасет мир!
  Поэтому и я готова делиться с Вами своим опытом и всей информацией, которой владею
  (в сфере детства, реабилитации и организации досуга для особых детей).
  Всегда рада быть полезной!</p>
        </div>

      </div>
    </div>
    <div class="container">
      <div class="box img-rounded shaded text-centered">
        <h3 class="txt-red">ХОТИТЕ ПОПАСТЬ В ЭТОТ РАЗДЕЛ?</h3>
        <h3 class="txt-green">МЫ СОБИРАЕМ АКТИВНОЕ СООБЩЕСТВО РОДИТЕЛЕЙ! ПРИСОЕДИНЯЙТЕСЬ!</h3>
      </div>
    </div>
  </div>

  <div id="partner-slide">
    <div class="slide-header"><h1><span class="txt-purple">Наши</span> <span class="txt-red">П</span><span class="txt-orange">А</span><span class="txt-green">Р</span><span class="txt-sky">Т</span><span class="txt-blue">Н</span><span class="txt-purple">Е</span><span class="txt-red">Р</span><span class="txt-green">Ы</span></h1></div>

    <div class="container review">
      <div class="row">
        <div class="col-md-3 col-12 order-">
          <a href="https://gaga.ru/" target="_blank"><img src="img/partners/gaga.jpg" alt="GaGa.ru" border="0"/></a>

        </div>
        <div class="col-md-8 col-md-offset-1 col-12">
          <p class="txt-purple" style="font-family: 'Source Sans Pro'; font-weight: 700">GaGa.ru - самая большая сеть магазинов настольных игр в Санкт-Петербурге, где каждый сможет найти настолку для себя, а опытные профессионалы всегда подскажут, посоветуют и помогут выбрать среди огромного множества и разнообразия настольных игр "ту самую". А еще в самом центре города есть замечательный (а также самый большой в России и Европе) игровой клуб Playloft GaGa, где вы найдете огромную коллекцию более 1500 настольных игр, X-box, PS4 и другие приставки, кикер и аркадный автомат, а консультанты по играм всегда помогут разобраться с особо сложной настолкой. Если вы любите настольные игры также, как ребята из GaGa, то обязательно приходите в магазины и в Playloft GaGa и погрузитесь в необыкновенный мир настольных игр!</p>
        </div>
      </div>
    </div>
</div>


  <div class="modal fade" id="betaModal" tabindex="-1" role="dialog" aria-labelledby="beta" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="beta">Добро пожаловать!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Добро пожаловать на проект FamilyOnMap!</h3>
        <!-- <p>Этот проект создан для того, чтобы объединить и облегчить жизнь тем, кому не хватает времени на поиски удобных и пригодных для досуга мест.</p> -->
        <p>Проект находится на стадии бета-тестирования, и его будущее - всецело в именно Ваших руках!</p>
        <p>Если Вы найдете какую-либо ошибку, неточность в работе или же у Вас появится идея для проекта - смело пишите нам: <a href="mailto:familyonmap@coffeesquad.ru">тык сюда</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Закрыть</button>
      </div>
    </div>
  </div>
</div>

  <?php require_once 'modals.php'; ?>
  <?php require_once 'footer.php'; ?>
</body>
</html>
