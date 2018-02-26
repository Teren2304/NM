

var app = new Vue({
	el: "#main",
	data: {
		domain: 'https://news-market.info',

		activeMenu: false,
      	notActive: 'show-menu--not-active',
      	yesActive: 'show-menu--active',
      	currencyWeather: [],
      	urlCurrencyWeather: window.location.href+'/currency',





		news: [],
		currencyCategory: [],
		
		searchString: "",
		step: 0,
		active: 'all',
		category: 'all',
		time: 'all',

		urlGetSortData: window.location.href,

		clickedSource: {},
		clickedNewsSeen: {},

		showLoading: true,
		emptyMessage: false,
		showPreloader: true,
		showSocialIcons: false,

		modalShadow: false,
		modalAbout: false,
		modalError: false,
		modalFeedback: false,
		modalFeedbackSend: false,
		feedback: {
			name: '',
			email: '',
			text: '',
			subject: [
				{text: 'Общие вопросы', value: 1},
				{text: 'Сотрудничество', value: 2},
				{text: 'Жалоба', value: 3},
				{text: 'Надо улучшать', value: 4}
			],
			selected: 1
		},


		responceLenght: 0,
		checkSearchField: false,
		shareLink: '',
		shareVariant: 0,
		shareTwitterTitle: '',

		countFoCookie: 0,
		arrayCookie: [],	
	},
	created: function(){
		this.setHeight()
		this.clearNews()
		this.getSortNews()
		this.getCurrencyWeather()
		this.getDate()
	},
	mounted: function(){
		this.setHeight()
        this.preloader()
    },
	methods: {
		setHeight: function(){
			var allHeight = window.innerHeight;
			var headerHeight = document.getElementById('header').offsetHeight;
			var contentHeight = allHeight - headerHeight 
			document.body.offsetHeight = document.getElementById("content").style.height = contentHeight + 'px'
		},
		preloader: function(){
			this.showPreloader = false
		},
		setCookie: function(){
			if (this.checkSearchField != false) {
				if (document.cookie != "") {
					this.arrayCookie = document.cookie.split('; ')
					this.countFoCookie = this.arrayCookie.length - 2
					this.countFoCookie++
					document.cookie = "s"+this.countFoCookie+"="+this.searchString+";"
				}
				else{
					document.cookie = "name=search;"
					document.cookie = "host=https://news-market.info"
					this.countFoCookie++
					document.cookie = "s"+this.countFoCookie+"="+this.searchString+";"
				}
				
				if (this.arrayCookie[0] != undefined) {
					console.log("Good")
				}
				else{
					console.log("Not good")
				}
				console.log(document.cookie)
			}	
		},
		share: function(){
			h = encodeURIComponent(window.location.href+window.location.hash);
	    	t = encodeURIComponent(this.shareTwitterTitle);
	    	if(this.shareVariant==1)
		   		h = 'https://www.facebook.com/share.php?u='+this.shareLink;
		   	else if(this.shareVariant==2)
		       	h = 'https://twitter.com/timeline/home?status='+t+'%20'+this.shareLink;
		   	else if(this.shareVariant==3)
		       	h = 'https://plus.google.com/share?url='+this.shareLink;
		    else if(this.shareVariant ==4)
		    	h = 'https://www.linkedin.com/sharing/share-offsite?mini=true&url='+this.shareLink;
		   	else
		       return false;
	    	window.open(h, 'Soc','screenX=100, screenY=100, height500, width=500, location=no, toolbar=no, directories=no, menubar=no, status=no');
		},
		getSortNews: function(){
			this.showLoading = true
			var formData = this.toFormData(this.clickedSource);
			if (this.checkSearchField == false) {
				var setUrl = this.urlGetSortData+"news/"+this.category+"/"+this.step+"/"+this.time+"/1"
			}
			else{
				var setUrl = this.urlGetSortData+"news/"+this.category+"/"+this.step+"/search/"+this.searchString			
			}
			axios.post(setUrl, formData).then(function(responce){
					this.clickedSource = {}
					app.showLoading = false;
					var json = responce.data
						news = json
					app.news = app.news.concat(this.news)
					app.emptyMessageShow(app.news.length)
					this.responceLenght = responce.data.length;
			});
		},
		colorSearch: function(text){
			if (app.searchString != "") {
				return text.replace(new RegExp(this.searchString, 'gi'), '<span class="select-word">$&</span>');
			}
			else{
				return text;
			}	
		},

		/*insertIntoFeedback: function(){
			var formData = app.toFormData(app.feedback);
			axios.post(window.location.href+'include_php/Feedback.php', formData).then(function(responce){
				app.modalFeedback = false
				app.modalFeedbackSend = true
				app.feedback = {name: "", selected: 1, email: "", text: ""};
			});
		},*/



		emptyMessageShow: function(length){
			if (length == 0)
				app.emptyMessage = true
			else
				app.emptyMessage = false
		},
		clearNews: function(){
			this.step = 0
			this.news.length=0
		},
		onScroll: function(event){
			var wrapper = event.target,
			list = wrapper.firstElementChild
			var scrollTop = wrapper.scrollTop,
				wrapperHeight = wrapper.offsetHeight,
				listHeight = list.offsetHeight
			var diffHeight = listHeight - wrapperHeight
			if (diffHeight <= scrollTop && responceLenght != 0) {
				++this.step;
				this.getSortNews()
			}
			else{
				return false;
			}
		},
		onClick: function(event){
			var modal = event.target,
			modalBlock = modal.parentNode.parentNode.nextElementSibling
			var modalBlockActive = document.getElementsByClassName('show')
			for (var i = 0; i < modalBlockActive.length; i++) {
				modalBlockActive[i].classList.remove("show")
			}
			var modalBlockActive = document.getElementsByClassName('active')
			for (var i = 0; i < modalBlockActive.length; i++) {
				modalBlockActive[i].classList.remove("active")
			}
			if (modalBlock.classList.contains('show')) {
				modalBlock.classList.remove("show")
				modalBlock.parentElement.classList.add("active")
			}
			else{
				modalBlock.classList.add("show")
				modalBlock.parentElement.classList.add("active")
				var img = modalBlock.querySelector("#article__content__img");
				if (img){
					img.setAttribute('src', img.getAttribute('realsrc'))
				}
			}
		},
		onClickClose: function(event){
			var close = event.target
			closeModalBlock = close.parentElement
			closeModalBlock.classList.remove("show")
			closeModalBlock.parentElement.classList.remove("active")
		},

		/*=== MENU ===*/
		showMenu(){
	      this.activeMenu =! this.activeMenu
	      var a = document.getElementById('menu');
	      a.classList.toggle("hideMenu");
	    },
		getDate: function(){
			function thisDate(){	
				var date = new Date();
				var hours = date.getHours();
				var minutes = date.getMinutes();
				var seconds = date.getSeconds();
				if(seconds < 10) { seconds = '0' + seconds; }
				if(minutes < 10) { minutes = '0' + minutes; }
				if(hours < 10) { hours = '0' + hours; }
				document.getElementById('timedisplay').innerHTML = hours + ':' + minutes + ':' + seconds;
			}
			setInterval(thisDate, 0)
		},
		getCurrencyWeather: function(){
			axios.get(this.urlCurrencyWeather).then(function(responce){
				var json = responce.data	
				app.currencyWeather = json
			});
		},
		/*=== MENU ===*/

		selectNews(news){
			app.clickedSource = news
		},
		getCurrencyWeather: function(){
			var formData = this.toFormData(this.clickedNewsSeen);
			axios.post(this.urlCurrencyWeather).then(function(responce){
				var json = responce.data	
				app.currencyWeather = json
			});
		},

		/*=== UPDATE SEEN ===*/
		selectNewsSeen(news){
			app.clickedNewsSeen = news
		},
		getUpdateSeen: function(){
			var formData = this.toFormData(this.clickedNewsSeen);
			var setUrl = "http://localhost/seen/"+this.category;
			axios.post(setUrl, formData).then(function(responce){
					var a = app.news.find(x=>x.id === app.clickedNewsSeen.id); a.seen ++;
					this.clickedNewsSeen = {}
			});
		},
		/*=== UPDATE SEEN ===*/

		toFormData: function(obj){
			var form_data = new FormData();
			for (var key in obj) {
				form_data.append(key, obj[key]);}
			return form_data;
		},

		sort: function(){
			app.news.sort(function(a, b){
				return b.seen - a.seen;
			})
		}
	},
	computed: {
		isFeedbackName(){
			return /^[a-zA-Zа-яА-Яёа-яА-ЯґєҐЄІіЇїa-zA-Z-а-яА-ЯёЁ]{3,16}$/.test(this.feedback.name)
		},
		isFeedbackText(){
			return /^[a-zA-Zа-яА-Яёа-яА-ЯґєҐЄІіЇїa-zA-Z-а-яА-ЯёЁ0-9\s]{10,200}$/.test(this.feedback.text)
		},
		isFeedbackEmail(){
			return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.feedback.email)
		}
	}
});
