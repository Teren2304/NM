<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrator Panel</title>
	<meta name="keywords" content="Ключевые слова, и, фразы, через, запятую">
    <meta name="description" content="Описание контента страницы, 1-2 предложения.">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css" />
</head>

<header>
	<nav>
		<div class="container">
			<ul>
				<li class="logo">
					<a href="http://localhost/parser/">News Market</a>
				</li>
				<li><a>Выйти</a></li>
			</ul>
		</div>
	</nav>
</header>

<main id="main" class="main">
<div class="container">
	<h3>Таблица источников</h3>
	<div class="table source">
		<div class="source__string title">
			<div class="delete"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
			<div class="change"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
			<div class="id"><p>status</p></div>
			<div class="name"><p>name</p></div>
			<div class="icon"><p>icon</p></div>
			<div class="link"><p>link</p></div>
			<div class="category"><p>category</p></div>
		</div>
		<div class="source__string">
			<div class="delete">
				<i class="fa fa-plus-square-o add" @click="insertIntoSource()" aria-hidden="true" title="Внести в базу"></i>
			</div>
			<div class="change"></div>
			<div class="id">
				<select v-model="newSource.status">
					<option value="0">Off</option>
					<option value="1">On</option>
				</select>
			</div>
			<div class="name"><input type="text" v-model="newSource.name" placeholder="Name" autocomplete="off" required></div>
			<div class="icon"><input type="text" v-model="newSource.icon" placeholder="Icon" autocomplete="off" required></div>
			<div class="link"><input type="text" v-model="newSource.link" placeholder="Link" autocomplete="off" required></div>
			<div class="category"><input type="text" v-model="newSource.category" placeholder="Category" autocomplete="off" required></div>
		</div>
		<div class="source__string" v-for="item in news">
			<div class="delete">
				<i class="fa fa-minus-circle delete__icon" title="Удалить" aria-hidden="true" @click="modalDelete = true; modalShadow = true; selectSource(item);"></i>
				<i class="fa fa-trash" title="Очистить все новости даного источника" aria-hidden="true" @click="modalDeleteNews = true; modalShadow = true; selectSource(item);"></i>
			</div>
			<div class="change">
				<i class="fa fa-pencil change__icon" title="Изменить" aria-hidden="true" @click="modalUpdate = true; modalShadow = true; selectSource(item)"></i>
			</div>
		    <div class="id">
		    	<p class="on" v-if="item.status==1">On</p>
		    	<p class="off" v-else>Off</p>
		    </div> 
			<div class="name">{{ item.name }}</div>
			<div class="icon">{{ item.icon }}</div>
			<div class="link">{{ item.link }}</div>
			<div class="category">{{ item.category }}</div>
		</div>
	</div>


	<div class="shadow" v-if="modalShadow"></div>
	<div class="modal-update" v-if="modalUpdate" id="modal">
		<p class="close" title="Закрыть" @click="modalUpdate = false; modalShadow = false"></p>
		<p>Изменить данные</p>
		<div class="name">
			<select v-model="clickedSource.status">
				<option value="0">Off</option>
				<option value="1">On</option>
			</select>
		</div>
		<div class="name"><input type="text" v-model="clickedSource.name" placeholder="Name" autocomplete="off" required></div>
		<div class="icon"><input type="text" v-model="clickedSource.icon" placeholder="Icon" autocomplete="off" required></div>
		<div class="link"><input type="text" v-model="clickedSource.link" placeholder="Link" autocomplete="off" required></div>
		<div class="category"><input type="text" v-model="clickedSource.category" placeholder="Category" autocomplete="off" required></div>
		<button @click="modalUpdate = false; modalShadow = false; updateSource()">Изменить запись</button>
	</div>
	<div class="modal-delete" id="modal" v-if="modalDelete">
		<p class="close" title="Закрыть" @click="modalDelete = false; modalShadow = false;"></p>
		<p>Удалить?</p>
		<div>
			<button @click="modalDelete = false; modalShadow = false; deleteSource()">Да</button>
			<button @click="modalDelete = false; modalShadow = false;">Нет</button>
		</div>
	</div>
	<div class="modal-delete" id="modal" v-if="modalDeleteNews">
		<p class="close" title="Закрыть" @click="modalDeleteNews = false; modalShadow = false;"></p>
		<p>Удалить все новости?</p>
		<div>
			<button @click="modalDeleteNews = false; modalShadow = false; deleteSourceNews()">Да</button>
			<button @click="modalDeleteNews = false; modalShadow = false;">Нет</button>
		</div>
	</div>






	<h3>Таблица обратной связи</h3>
	<div class="table feedback">
		<div class="title string">
			<div class="delete"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
			<div><p>Id</p></div>
			<div><p>Name</p></div>
			<div><p>Subject</p></div>
			<div><p>E-mail</p></div>
			<div><p>Action</p></div>
		</div>
		<div v-for="item in feedback">
			<div v-if="item.action==1">
				<div class="string">
					<div>
						<i class="fa fa-minus-circle delete__icon" title="Удалить" aria-hidden="true" @click="modalDeleteFeedback = true; modalShadow = true; selectSource(item);"></i>
						<i class="fa fa-external-link modal__icon" title="Открыть модальное окно" aria-hidden="true" @click="onClick"></i>
					</div>
					<div><p>{{ item.id }}</p></div>
					<div><p>{{ item.name }}</p></div>
					<div><p>{{ item.subject }}</p></div>
					<div><p>{{ item.mail }}</p></div>
					<div><a @click="selectSource(item); updateFeedback()">Подтвердить</a></div>
				</div>
				<div class="modal">
					<p>{{ item.text }}</p>
				</div>
			</div>
			<div v-if="item.action==0">
				<div class="string">
					<div>
						<i class="fa fa-minus-circle delete__icon" title="Удалить" aria-hidden="true" @click="modalDeleteFeedback = true; modalShadow = true; selectSource(item);"></i>
						<i class="fa fa-external-link modal__icon" title="Открыть модальное окно" aria-hidden="true" @click="onClick"></i>
					</div>
					<div><p>{{ item.id }}</p></div>
					<div><p>{{ item.name }}</p></div>
					<div><p>{{ item.subject }}</p></div>
					<div><p>{{ item.mail }}</p></div>
					<div><p>Просмотрено</p></div>
				</div>
				<div class="modal">
					<p>{{ item.date }}</p>
					<p>{{ item.text }}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="modal-delete" id="modal" v-if="modalDeleteFeedback">
		<p class="close" title="Закрыть" @click="modalDeleteFeedback = false; modalShadow = false;"></p>
		<p>Удалить все новости?</p>
		<div>
			<button @click="modalDeleteFeedback = false; modalShadow = false; deleteFeedback()">Да</button>
			<button @click="modalDeleteFeedback = false; modalShadow = false;">Нет</button>
		</div>
	</div>


</div><!--container-->
</main><!--main-->




<script src="js/vue.js"></script>
<script src="js/axios.min.js"></script>
<script>
var app = new Vue({
	el: "#main",
	data: {
		modalDeleteFeedback: false,
		modalShadow: false,
		modalUpdate: false,
		modalDelete: false,
		modalDeleteNews: false,
		news: [],
		feedback: [],
		newSource: {name: "", icon: "", link: "", category: "", status: ""},
		urlInsertSource: 'http://localhost/news_market/admin/include_php/Source.php?action=',
		urlActionFeedback: 'http://localhost/news_market/admin/include_php/Feedback.php?action=',
		clickedSource: {}
	},
	created: function(){
		this.getSource()
		this.getFeedback()
	},
	methods: {
		getSource: function(){
			axios.get(this.urlInsertSource+'read').then(function(responce){
				app.news.length=0
				var json = responce.data
				app.news = json
			});
		},
		insertIntoSource: function(){
			var formData = app.toFormData(app.newSource);
			axios.post(this.urlInsertSource+'add', formData).then(function(responce){
				app.newSource = {name: "", icon: "", link: "", category: "", status: ""};
					app.getSource()
			});
		},
		updateSource: function(){
			var formData = app.toFormData(app.clickedSource);
			axios.post(this.urlInsertSource+'update', formData).then(function(responce){
				app.clickedSource = {}
					 app.getSource()
			});
		},
		deleteSource: function(){
			var formData = app.toFormData(app.clickedSource);
			axios.post(this.urlInsertSource+'delete', formData).then(function(responce){
				app.clickedSource = {};
				app.getSource()
			});
		},
		deleteSourceNews: function(){
			var formData = app.toFormData(app.clickedSource)
			axios.post(this.urlInsertSource+'delete_all_news', formData).then(function(responce){
				app.clickedSource = {};
					app.getSource()
			});
		},
		getFeedback: function(){
			axios.get(this.urlActionFeedback+'read').then(function(responce){
				app.feedback.length=0
				var json = responce.data
				app.feedback = json
			});
		},
		deleteFeedback: function(){
			var formData = app.toFormData(app.clickedSource);
			axios.post(this.urlActionFeedback+'delete', formData).then(function(responce){
				app.clickedSource = {};
				app.getFeedback()
			});
		},
		updateFeedback: function(){
			var formData = app.toFormData(app.clickedSource);
			axios.post(this.urlActionFeedback+'update', formData).then(function(responce){
				app.clickedSource = {}
				app.getFeedback()
			});
		},


		onClick: function(event){
			var modal = event.target,
			modalBlock = modal.parentNode.parentNode.nextElementSibling
			
			console.log(modalBlock)

			var modalBlockActive = document.getElementsByClassName('show')
			for (var i = 0; i < modalBlockActive.length; i++) {
				modalBlockActive[i].classList.remove("show")
			}

			if (modalBlock.classList.contains('show')) {
				modalBlock.classList.remove("show")
			}
			else{
				modalBlock.classList.add("show")
			}		
		},
		selectSource(source){
			app.clickedSource = ''
			app.clickedSource = source
		},
		toFormData: function(obj){
			var form_data = new FormData();
			for (var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		}
	}
});
</script>


</body>
</html>



