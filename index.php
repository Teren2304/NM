<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0">
	<title>Последние новости и события Украины</title>
	<meta name="keywords" content="Новости, вести, события, последние, горячее, в Украине, агрегатор">
    <meta name="description" content="News-market агрегатор новостей и событий Украины. Сервис предлагает Вашему вниманию последние новости, используя 4 временных интервала.">


	
	


	<link rel="stylesheet" href="css/style.css">
	
    <link rel="apple-touch-icon" sizes="57x57" href="img/icons/apple-icon-57x57.png">
  	<link rel="apple-touch-icon" sizes="60x60" href="img/icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-icon-72x72.png">
  	<link rel="apple-touch-icon" sizes="76x76" href="img/icons/apple-icon-76x76.png">
  	<link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-icon-114x114.png">
  	<link rel="apple-touch-icon" sizes="120x120" href="img/icons/apple-icon-120x120.png">
  	<link rel="apple-touch-icon" sizes="144x144" href="img/icons/apple-icon-144x144.png">
  	<link rel="apple-touch-icon" sizes="152x152" href="img/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="48x48" href="img/icons/favicon-48x48.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/icons/favicon-192x192.png">
<!-- 1260 -->

<!-- 	16 <link rel="icon" href="http://www.example.com/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.example.com/favicon.ico" type="image/x-icon" /> -->
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="/img/icons/apple-icon-144x144.png">
	<meta name="theme-color" content="#FFFFFF">

	<meta property="og:url" content="https://news-market.info" />
	<meta property="og:title" content="Последние новости и события Украины" />
	<meta property="og:image:secure_url" content="https://news-market.info/img/icons/apple-icon-76x76.png" />
	<meta property="og:description" content="News-market агрегатор новостей и событий Украины. Сервис предлагает Вашему вниманию последние новости, используя 4 временных интервала." />
	<link rel="canonical" href="https://news-market.info">
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112700427-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-112700427-1');
</script>
 -->
 <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">
</head>
<style>
	[v-cloak]{
  		display: none;}
	.source{
		border: 1px solid red;
	}
	.source__string{
		border: 1px solid red;
		display: flex;
		align-items: center;
		padding: 10px;
	}
	.source__string img{
		width: 18px;
	    height: 18px;
	}
	.source__string span:first-child{
		width: 40px;
		font-weight: bold;
	}
	.source__string span:last-child{
		margin-left: 10px;
	}

</style>
<!-- <body onResize="setHeight();"> -->
<body>

<main id="main">


<div class="preloader" v-show="showPreloader">
	<div class="spinner">
		<div class="rect1"></div>
		<div class="rect2"></div>
		<div class="rect3"></div>
		<div class="rect4"></div>
		<div class="rect5"></div>
	</div><!--spinner-->
	<div class="logo">
		<div class="logo__icon">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div><!--logo__icon-->
		<div class="logo__text">
			<h1>News-Market</h1>
			<span>Latest news in ukraine</span>
		</div><!--logo__text-->
	</div><!--logo-->
</div><!--preloader-->


<header id="header" class="header">
	<div class="container">
		<div class="logo">
			<a href="https://news-market.info" class="logo__icon" title="news-market.info">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</a><!--logo__icon-->
			<div class="logo__text">
				<h2>News-Market</h2>
				<span>Latest news in ukraine</span>
			</div><!--logo__text-->
		</div><!--logo-->
		<div class="search">
			<form>
				<input type="text" 
					v-model="searchString"
					class="search__field" 
					placeholder="Искать..."/>
					<!--search__field-->
				<button type="submit" 
					v-if="searchString.length >= 4"
					class="search__icon"
					title="Искать новости"
					@click.prevent="clearNews();checkSearchField = true;getSortNews();setCookie()">
				</button><!--search__icon-->
				<button v-else
					class="search__icon"
					title="Искать новости"
					@click.prevent="modalError=true;modalShadow=true">
				</button><!--search__icon-->
			</form><!--form-->
		</div><!--search-->
		<div :class="[activeMenu ? yesActive : notActive]"
		    class="show-menu"
		    title="Показать меню"
		    @click="showMenu">
		    <span></span>
		</div><!--show-menu-->
	</div><!--container-->
	<div class="container">
		<ul class="sort-list" v-if="checkSearchField == false" v-bind:class="active" v-on:click.prevent>
			<li><a class="online" @click="clearNews(); time = 'all'; active = 'online'; getSortNews()">Все новости</a></li>
			<li><a class="minute" @click="clearNews(); time = '10'; active = 'minute'; getSortNews()">10 мин.</a></li>
			<li><a class="hours" @click="clearNews(); time = '60'; active = 'hours'; getSortNews()">Час</a></li>
			<li><a class="day" @click="clearNews(); time = 'day'; active = 'day'; getSortNews()">Сутки</a></li>
		</ul><!--sort-list-->
		<ul class="sort-list" v-else v-bind:class="active" v-cloak>
			<li><a class="online disabled">Все новости</a></li>
			<li><a class="minute disabled">10 мин.</a></li>
			<li><a class="hours disabled">Час</a></li>
			<li><a class="day disabled">Сутки</a></li>
		</ul><!--sort-list-->
		<ul class="search-list" v-cloak>
			<li v-if="clickedSource.name_source != undefined" v-cloak>
				<a title="Сортировка по источнику" 
					@click="clickedSource = false; clearNews(); getSortNews()">
					<span>{{ clickedSource.name_source }}</span>
		       		<p class="close"></p>
				</a>
			</li>
			<li v-if="checkSearchField == true" v-cloak>
				<a title="Результаты поиска" 
					@click='checkSearchField = false; clearNews(); searchString = ""; getSortNews();'>
					<span>{{ searchString }}</span>
		       		<p class="close"></p>
				</a>
			</li>
		</ul><!--search-list-->
	</div><!--container-->
</header><!--header-->




<!-- <div class="content container" id="content" @scroll="onScroll"> -->

<div class="content container" id="content">
	<ul class="articles">
		<li v-for="item in news">
			<article class="article">
				<header class="article__header">
					<h2>
						<img v-bind:src="item.news_source_img" 
					 		 v-bind:alt="item.name_source" 
							 v-bind:title="item.name_source" @click="selectNews(item); clearNews(); getSortNews()"/>
						<a v-html="colorSearch(item.news_title)" @click="onClick">{{ item.news_title }}</a>
					</h2>
				</header><!--header-->	
				<div class="article__content">
					<p class="close" title="Закрыть" @click="onClickClose"></p>
					<img v-if="item.news_img"
						 v-bind:src="item.news_img"
						 width=auto 
						 height=auto 
						 id="article__content__img" 
						 v-bind:realsrc="item.news_img"/>
					<div class="description clearfix">
						<p>{{ item.news_description }}</p>
						<ul>
							<li class="facebook">
								<a @click=" shareLink = item.news_link; 
											shareVariant = 1; 
											share()"/></a>
							</li>
							<li class="twitter">
								<a @click=" shareLink = item.news_link; 
											shareVariant = 2; 
											shareTwitterTitle = item.news_title; 
											share()"/></a>
							</li>
							<li class="google">
								<a @click=" shareLink = item.news_link; 
											shareVariant = 3; 
											share()"/></a>
							</li>
							<li>
								<a  v-bind:href="item.news_link" 
									target="_blank" 
									class="btn">Подробнее</a>
							</li>
						</ul><!--social-->
					</div><!--description clearfix-->
				</div><!--content-->
				<footer class="article__footer">
					<div class="wrapper">
						<p class="public-date" title="Дата публикации">{{ item.news_date }}</p>
						<a  v-bind:href="item.news_source_link"
						 	target="_blank" 
							class="public-source" 
							title="Источник публикации">{{ item.news_source_link }}</a>
					</div>
					<p class="public-seen" title="Количество просмотров">{{ item.seen }}</p>
				</footer><!--footer-->
			</article><!--article-->	
		</li><!--li-->
	</ul><!--articles-->
	<button class="btn" @click="showMore()">Show more</button>
</div><!--content-->









<aside class="menu show hide" id="menu">
	<nav>
		<ul class="menu__category" v-bind:class="category" v-on:click.prevent>
		    <li class="menu__category--subtitle">
		      <h3>News-market</h3> 
		      <p>Обзор, новостей Украины за 30.01.2018, <span id="timedisplay"></span></p>
		    </li>
		    <li>
				<a class="all" 
					@click="clearNews(); 
					category = 'all'; 
					getSortNews(); 
					showMenu()">
					<i class="fa fa-newspaper-o" aria-hidden="true"></i>
					<span>Все новости</span>
				</a>
			</li>
			<li>
				<a class="politic" 
					@click="clearNews(); 
					category = 'politic'; 
					getSortNews(); 
					showMenu()">
					<i class="fa fa-handshake-o" aria-hidden="true"></i>
					<span>Политика</span>
				</a>
			</li>
			<li>
				<a class="economy" 
					@click="clearNews(); 
					category = 'economy'; 
					getSortNews(); 
					showMenu()">
					<i aria-hidden="true" class="fa fa-bar-chart"></i>
					<span>Экономика</span>
				</a>
			</li>
			<li>
				<a class="technology" 
					@click="clearNews(); 
					category = 'technology'; 
					getSortNews(); 
					showMenu()">
					<i aria-hidden="true" class="fa fa-cubes"></i>
					<span>Технологии</span>
				</a>
			</li>
			<li>
				<a class="world" 
					@click="clearNews(); 
					category = 'world'; 
					getSortNews(); 
					showMenu()">
					<i aria-hidden="true" class="fa fa-globe"></i>
					<span>В мире</span>
				</a>
			</li>
			<li>
				<a class="auto" 
					@click="clearNews();
					category = 'auto'; 
					getSortNews(); 
					showMenu()">
					<i aria-hidden="true" class="fa fa-car"></i>
					<span>Авто</span>
				</a>
			</li>
			<li>
				<a  class="sport" 
					@click="clearNews(); 
					category = 'sport'; 
					getSortNews(); 
					showMenu()">
					<i class="fa fa-futbol-o" aria-hidden="true"></i>
					<span>Спорт</span>
				</a>
			</li>
		</ul>
		<!--menu__category-->
	</nav><!--nav-->
	<ul class="menu__currency" v-for="item in currencyWeather">
	      	<li class="menu__currency-weather">
			<i class="fa fa-cloud" aria-hidden="true"></i>
			<i class="fa fa-sun-o" aria-hidden="true"></i>
			<h2>{{ item.weather }}&deg;C</h2>
		</li>
		<li title="Доллар">
			<i class="fa fa-usd" aria-hidden="true"></i>
			<span>{{ item.USD_sale }}</span>
			<span>&mdash;{{ item.USD_buy }}</span>
		</li>
		<li title="Евро">
			<i class="fa fa-eur" aria-hidden="true"></i>
			<span>{{ item.EUR_sale }}</span>
			<span>&mdash;{{ item.EUR_buy }}</span>
		</li>
		<li title="Рубль">
			<i class="fa fa-rub" aria-hidden="true"></i>
			<span>{{ item.RUR_sale }}</span>
			<span>&mdash;{{ item.RUR_buy }}</span>
		</li>
		<li title="Bitcoin">
			<i class="fa fa-btc" aria-hidden="true"></i>
			<span>{{ item.Bitcoin_sale }}</span>
			<span>&mdash;{{ item.Bitcoin_buy }}</span>
		</li>
	</ul><!--right__currency-->
	<div class="menu__info">
	  <ul>
	    <li>
	    	<a @click="modalAbout=true;modalShadow=true">
	    		<i aria-hidden="true" class="fa fa-question-circle-o"></i>
	    		<span>О нас</span>
	    	</a>
		</li>
	    <li>
	    	<a @click="modalFeedback=true;modalShadow=true">
	    		<i aria-hidden="true" class="fa fa-info-circle"></i>
	    		<span>Обратная связь</span>
	    	</a>
	    </li>
	    <li><p><i aria-hidden="true" class="fa fa-copyright"></i><span>2018. News Market</span></p></li>
	  </ul>
	</div><!--menu__info-->
</aside><!--menu-->













<div class="shadow" v-if="modalShadow" v-cloak></div>
<div class="modal modal__feedback" v-if="modalFeedback" v-cloak>
	<p class="close" title="Закрыть" @click="modalFeedback=false;modalShadow=false"></p>
	<h4>Обратная связь</h4>
	<p v-if="feedback.name && !isFeedbackName">От 3 до 16 символов!</p>
	<input  type="text"
			id="feedback_name"
			v-model="feedback.name"
			placeholder="Имя...">
	<select v-model="feedback.selected">
		<option v-for="option in feedback.subject" 
				v-bind:value="option.value">{{ option.text }}</option>
	</select>
	<p v-if="feedback.email && !isFeedbackEmail">Некорректный email!</p>
	<input 	type="email" 
			id="feedback_e-mail" 
			v-model="feedback.email"
			placeholder="E-mail...">
	<p v-if="feedback.text && !isFeedbackText">От 10 до 200 символов!</p>
	<textarea 	id="feedback_text"
				placeholder="Текст сообщения...."
				v-model="feedback.text"></textarea>
	<button v-if="feedback.name && isFeedbackName &&
  				  feedback.email && isFeedbackEmail &&
				  feedback.text && isFeedbackText"
			class="btn" 
			@click="insertIntoFeedback">Отправить</button>
	<button v-else disabled>Отправить</button>
</div><!--modalFeedback-->
<div class="modal center" v-if="modalFeedbackSend" v-cloak>
	<p class="close" title="Закрыть" @click="modalFeedbackSend=false;modalShadow=false"></p>
	<h4>Отзыв отправлен!</h4>
	<p>Ваше мнение очень важно для нас, в ближайшее время Вы получите ответ по даному вопросу.</p> 
	<p>Спасибо за отклик.</p>
</div><!--modalFeedbackSend-->
<div class="modal modal__about" v-if="modalAbout" v-cloak>
	<p class="close" title="Закрыть" @click="modalAbout=false;modalShadow=false"></p>
	<h4>O нас</h4>
	<p><strong>News-Market</strong> - точка сбора самых свежих, интересных и актуальных новостей украинских медиа. Вы можете просмотреть ленту, или остановиться на конкретных темах, и получить выборку новостей по ним. При клике на заголовок новости, всплывает блок с кратким новостным описанием (время публикации, заглавие статьи, источник...), или на "Подробнее" вы попадете на полнотекстовый материал на сайте издания. Сортировка материалов по источнику поможет быстрее детализировать искомое (клик на конку источника), или воспользоваться словарным поиском в форме више. Сервис предлагает Вашему вниманию выборку материалов используя 4 временных интервала. Данные обновляються каждые 10 минут, что позволяет быть в курсе самых последних событий в стране.</p><br>
	<p>По вопросам сотрудничества обращайтесь на <a>admin@news-market.info</a>, или воспользуйтесь сервисом "Обратная связь".</p>
</div><!--modalAbout-->
<div class="modal modal__error center" v-if="modalError" v-cloak>
	<p class="close" title="Закрыть" @click="modalError=false;modalShadow=false"></p>
	<h4>Oшибка!</h4>
	<p>
		<i class="fa fa-meh-o" aria-hidden="true"></i>
		<span>Поисковый запрос не менее <br><strong>4</strong> символов</span>
	</p>
</div><!--modalError-->
<div class="social">
	<button class="social__show pulse" @click="showSocialIcons =! showSocialIcons"></button>
	<transition name="fade">
		<ul v-if="showSocialIcons">
		    <li class="facebook">
				<a @click="shareLink=domain; shareVariant = 1; share()"></a>
			</li>
			<li class="twitter">
				<a @click="shareLink=domain; shareVariant = 2; shareTwitterTitle = 'Последние новости и событий Украины'; share()"></a>
			</li>
			<li class="google">
				<a @click="shareLink=domain; shareVariant = 3; share()"></a>
			</li>
			<li class="linkedin">
				<a @click="shareLink=domain; shareVariant = 4; share()"></a>
			</li>
		</ul>
	</transition>
</div><!--social-->




</main><!--main-->






<script src="js/vue.js"></script>
<script src="js/axios.min.js"></script>

<!-- <script src="js/components/source.js"></script> -->

<script src="js/custom.js"></script>
<script>
	/*function setHeight() {
		var allHeight = window.innerHeight;
		var headerHeight = document.getElementById('header').offsetHeight;
		var contentHeight = allHeight - headerHeight 
		var content = document.getElementById("content").style.height = contentHeight + 'px'}
	setHeight();*/
</script>
</body>
</html>
