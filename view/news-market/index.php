<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0">
	<title>Последние новости и события Украины</title>
	<meta name="keywords" content="Новости, вести, события, последние, горячее, в Украине, агрегатор">
    <meta name="description" content="News-market агрегатор новостей и событий Украины. Сервис предлагает Вашему вниманию последние новости, используя 4 временных интервала.">
	<link rel="stylesheet" href="/view/news-market/template/css/style.css">
	
    <link rel="apple-touch-icon" sizes="57x57" href="/view/news-market/template/img/icons/apple-icon-57x57.png">
  	<link rel="apple-touch-icon" sizes="60x60" href="/view/news-market/template/img/icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/view/news-market/template/img/icons/apple-icon-72x72.png">
  	<link rel="apple-touch-icon" sizes="76x76" href="/view/news-market/template/img/icons/apple-icon-76x76.png">
  	<link rel="apple-touch-icon" sizes="114x114" href="/view/news-market/template/img/icons/apple-icon-114x114.png">
  	<link rel="apple-touch-icon" sizes="120x120" href="/view/news-market/template/img/icons/apple-icon-120x120.png">
  	<link rel="apple-touch-icon" sizes="144x144" href="/view/news-market/template/img/icons/apple-icon-144x144.png">
  	<link rel="apple-touch-icon" sizes="152x152" href="/view/news-market/template/img/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/view/news-market/template/img/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/view/news-market/template/img/icons/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/view/news-market/template/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="48x48" href="/view/news-market/template/img/icons/favicon-48x48.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/view/news-market/template/img/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/view/news-market/template/img/icons/favicon-192x192.png">
<!-- 1260 -->

<!-- 	16 <link rel="icon" href="http://www.example.com/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.example.com/favicon.ico" type="image/x-icon" /> -->
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="/view/news-market/template//img/icons/apple-icon-144x144.png">
	<meta name="theme-color" content="#FFFFFF">

	<meta property="og:url" content="https://news-market.info" />
	<meta property="og:title" content="Последние новости и события Украины" />
	<meta property="og:image:secure_url" content="https://news-market.info/view/news-market/template/icons/apple-icon-76x76.png" />
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
 <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet"> -->
</head>
<style>
	[v-cloak]{
  		display: none;}
</style>
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
		<div class="wrapper__box">
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
		</div>
		<div class="wrapper__box">
			<ul class="sort-list" v-if="checkSearchField == false" v-bind:class="active" v-on:click.prevent>
				<li><button class="btn all" @click="clearNews(); time = 'all'; active = 'all'; getSortNews()">Все новости</button></li>
				<li><button class="btn minute" @click="clearNews(); time = 'minute'; active = 'minute'; getSortNews()">10 мин.</button></li>
				<li><button class="btn hours" @click="clearNews(); time = 'hours'; active = 'hours'; getSortNews()">Час</button></li>
				<li><button class="btn day" @click="clearNews(); time = 'day'; active = 'day'; getSortNews()">Сутки</button></li>
				<li><button class="btn week" @click="clearNews(); time = 'week'; active = 'week'; getSortNews()">Неделя</button></li>
				<!-- <li><a @click="sort()">Sort</a></li> -->
			</ul><!--sort-list-->
			<ul class="sort-list" v-else v-bind:class="active" v-cloak>
				<li><button class="btn all disabled">Все новости</button></li>
				<li><button class="btn minute disabled">10 мин.</button></li>
				<li><button class="btn hours disabled">Час</button></li>
				<li><button class="btn day disabled">Сутки</button></li>
				<li><button class="btn week disabled">Неделя</button></li>
			</ul><!--sort-list-->
			<ul class="search-list" v-cloak>
				<li v-if="clickedSource.news_source_link != undefined" v-cloak>
					<a title="Сортировка по источнику" 
						@click="clickedSource = false; clearNews(); getSortNews()">
						<span>{{ clickedSource.news_source_link }}</span>
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
		</div>
	</div><!--container-->
</header><!--header-->




<!-- <div class="content container" id="content" @scroll="onScroll"> -->

<div class="content container" id="content" @scroll="onScroll">
	

	<ul class="articles">
		<li v-if="showLoading" class="showLoading" v-cloak>
			<div class="spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div><!--spinner-->
		</li><!--showLoading-->
		<li v-if="emptyMessage" class="emptyMessage" v-cloak>
			<i class="fa fa-meh-o" aria-hidden="true"></i>
			<span>По запросу ничего не найдено </span>
		</li><!--emptyMessage-->
		<li v-for="item in news">
			<article class="article">
				<header class="article__header">
					<h2>
						<img v-bind:src="item.news_source_img" 
					 		 v-bind:alt="item.news_source_link" 
							 v-bind:title="item.news_source_link" @click="selectNews(item); clearNews(); getSortNews()"/>
						<a v-html="colorSearch(item.news_title)" @click="onClick">{{ item.news_title }}</a>
					</h2>
				</header><!--header-->
				<div class="article__content">
					<p class="close" title="Закрыть" @click="onClickClose"></p>
					<img v-if="item.news_img"
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
								<a  @click="selectNewsSeen(item); getUpdateSeen();"
									v-bind:href="item.news_link" 
									target="_blank" 
									class="btn">Подробнее</a>
							</li>
						</ul><!--social-->
					</div><!--description clearfix-->
				</div><!--article__content-->
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
</div><!--content-->


<aside class="menu showMenu hideMenu" id="menu">
	<ul class="menu__category" v-bind:class="category" v-on:click.prevent>
	    <li class="menu__item">
	      <h3 class="menu__title">News-market</h3> 
	      <p class="menu__text">Обзор, новостей Украины за 30.01.2018, <span id="timedisplay"></span></p>
	    </li>
	    <li class="menu__item">
			<a class="menu__link all" 
				@click="clearNews(); 
				category = 'all'; 
				getSortNews(); 
				showMenu()">
				<i class="fa fa-newspaper-o icon" aria-hidden="true"></i>
				<span>Все новости</span>
			</a>
		</li>
		<li class="menu__item">
			<a class="menu__link politic" 
				@click="clearNews(); 
				category = 'politic'; 
				getSortNews(); 
				showMenu()">
				<i class="fa fa-handshake-o icon" aria-hidden="true"></i>
				<span>Политика</span>
			</a>
		</li>
		<li class="menu__item">
			<a class="menu__link economy" 
				@click="clearNews(); 
				category = 'economy'; 
				getSortNews(); 
				showMenu()">
				<i aria-hidden="true" class="fa fa-bar-chart icon"></i>
				<span>Экономика</span>
			</a>
		</li>
		<li class="menu__item">
			<a class="menu__link technology" 
				@click="clearNews(); 
				category = 'technology'; 
				getSortNews(); 
				showMenu()">
				<i aria-hidden="true" class="fa fa-cubes icon"></i>
				<span>Технологии</span>
			</a>
		</li>
		<li class="menu__item">
			<a class="menu__link world" 
				@click="clearNews(); 
				category = 'world'; 
				getSortNews(); 
				showMenu()">
				<i aria-hidden="true" class="fa fa-globe icon"></i>
				<span>В мире</span>
			</a>
		</li>
		<li class="menu__item">
			<a class="menu__link auto" 
				@click="clearNews();
				category = 'auto'; 
				getSortNews(); 
				showMenu()">
				<i aria-hidden="true" class="fa fa-car icon"></i>
				<span>Авто</span>
			</a>
		</li>
		<li class="menu__item">
			<a class="menu__link sport" 
				@click="clearNews(); 
				category = 'sport'; 
				getSortNews(); 
				showMenu()">
				<i class="fa fa-futbol-o icon" aria-hidden="true"></i>
				<span>Спорт</span>
			</a>
		</li>
	</ul><!--menu-->
	<ul class="currency" v-for="item in currencyWeather">
	    <li class="currency__weather">
			<i class="fa fa-cloud" aria-hidden="true"></i>
			<i class="fa fa-sun-o" aria-hidden="true"></i>
			<h2 class="currency__title">{{ item.weather }}&deg;C</h2>
		</li>
		<li class="currency__item" title="Доллар">
			<i class="fa fa-usd icon" aria-hidden="true"></i>
			<span>{{ item.USD_sale }}</span>
			<span>&mdash;{{ item.USD_buy }}</span>
		</li>
		<li class="currency__item" title="Евро">
			<i class="fa fa-eur icon" aria-hidden="true"></i>
			<span>{{ item.EUR_sale }}</span>
			<span>&mdash;{{ item.EUR_buy }}</span>
		</li>
		<li class="currency__item" title="Рубль">
			<i class="fa fa-rub icon" aria-hidden="true"></i>
			<span>{{ item.RUR_sale }}</span>
			<span>&mdash;{{ item.RUR_buy }}</span>
		</li>
		<li class="currency__item" title="Bitcoin">
			<i class="fa fa-btc icon" aria-hidden="true"></i>
			<span>{{ item.Bitcoin_sale }}</span>
			<span>&mdash;{{ item.Bitcoin_buy }}</span>
		</li>
	</ul><!--currency-->
	<ul class="info">
	  <li class="info__item">
	  	<a @click="modalAbout=true;modalShadow=true" class="info__link">
	  		<i aria-hidden="true" class="fa fa-question-circle-o icon"></i>
	  		<span>О нас</span>
	  	</a>
		</li>
	  <li class="info__item">
	  	<a @click="modalFeedback=true;modalShadow=true" class="info__link">
	  		<i aria-hidden="true" class="fa fa-info-circle icon"></i>
	  		<span>Обратная связь</span>
	  	</a>
	  </li>
	  <li class="info__item">
	  	<p class="info__text">
	  		<i aria-hidden="true" class="fa fa-copyright icon"></i>
	  		<span>2018. News Market</span>
	  	</p>
	  </li>
	</ul><!--info-->
</aside><!--menu-->




<div class="shadow" v-if="modalShadow" v-cloak></div>

<div class="modal modal__error" v-if="modalError" v-cloak>
	<p class="close modal__close" title="Закрыть" @click="modalError=false;modalShadow=false"></p>
	<h4 class="modal__title modal__title--red">Oшибка!</h4>
	<p class="modal__text modal__text--red center">
		<i class="fa fa-meh-o" aria-hidden="true"></i>
		<span>Поисковый запрос не менее <br><strong>4</strong> символов</span>
	</p>
</div><!--modalError-->

<div class="modal modal-feedback" v-if="modalFeedback" v-cloak>
	<p class="close modal__close" title="Закрыть" @click="modalFeedback=false;modalShadow=false"></p>
	<h4 class="modal__title">Обратная связь</h4>
	<p class="modal__text modal__text--red" v-if="feedback.name && !isFeedbackName">От 3 до 16 символов!</p>
	<input  type="text"
			id="feedback_name"
			v-model="feedback.name"
			placeholder="Имя...">
	<select v-model="feedback.selected">
		<option v-for="option in feedback.subject" 
				v-bind:value="option.value">{{ option.text }}</option>
	</select>
	<p class="modal__text modal__text--red" v-if="feedback.email && !isFeedbackEmail">Некорректный email!</p>
	<input 	type="email" 
			id="feedback_e-mail" 
			v-model="feedback.email"
			placeholder="E-mail...">
	<p class="modal__text modal__text--red" v-if="feedback.text && !isFeedbackText">От 10 до 200 символов!</p>
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

<div class="modal" v-if="modalFeedbackSend" v-cloak>
	<p class="close modal__close" title="Закрыть" @click="modalFeedbackSend=false;modalShadow=false"></p>
	<h4 class="modal__title">Отзыв отправлен!</h4>
	<p class="modal__text center">Ваше мнение очень важно для нас, в ближайшее время Вы получите ответ по даному вопросу.</p> 
	<p class="modal__text center">Спасибо за отклик.</p>
</div><!--modalFeedbackSend-->

<div class="modal modal-about" v-if="modalAbout" v-cloak>
	<p class="close modal__close" title="Закрыть" @click="modalAbout=false;modalShadow=false"></p>
	<h4 class="modal__title">O нас</h4>
	<p class="modal__text"><strong>News-Market</strong> - точка сбора самых свежих, интересных и актуальных новостей украинских медиа. Вы можете просмотреть ленту, или остановиться на конкретных темах, и получить выборку новостей по ним. При клике на заголовок новости, всплывает блок с кратким новостным описанием (время публикации, заглавие статьи, источник...), или на "Подробнее" вы попадете на полнотекстовый материал на сайте издания. Сортировка материалов по источнику поможет быстрее детализировать искомое (клик на конку источника), или воспользоваться словарным поиском в форме више. Сервис предлагает Вашему вниманию выборку материалов используя 4 временных интервала. Данные обновляються каждые 10 минут, что позволяет быть в курсе самых последних событий в стране.</p><br>
	<p class="modal__text">По вопросам сотрудничества обращайтесь на <a>admin@news-market.info</a>, или воспользуйтесь сервисом "Обратная связь".</p>
</div><!--modalAbout-->




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

<script src="/view/news-market/template/js/vue.js"></script>
<script src="/view/news-market/template/js/axios.min.js"></script>
<script src="/view/news-market/template/js/custom.js"></script>
</body>
</html>
