<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0">
	<title>Последние новости и события Украины</title>
	<meta name="keywords" content="Новости, вести, события, последние, горячее, в Украине, агрегатор">
    <meta name="description" content="News-market агрегатор новостей и событий Украины. Сервис предлагает Вашему вниманию последние новости, используя 4 временных интервала.">
	<link rel="stylesheet" href="css/style.css">
<body>
<style>
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

<main id="main">
<div class="content" id="content">

	<div class="source" id="source">
		<div v-for="item in source">
			<a class="source__string" href="#" target="_blank">
				<span>{{ item.id }}.</span>
				<img v-bind:src="item.icon"/>
				<span>{{ item.name }}</span>
			</a><!--news__string-->
		</div><!--item-->
	</div><!--source-->

</div><!--content-->
</main><!--main-->
<script src="js/vue.js"></script>
<script src="js/axios.min.js"></script>
<script src="js/source.js"></script>
</body>
</html>
