Vue.component('source-list', {
	template: '<div><div v-for="item in source"><a class="source__string" href="#" target="_blank"><span>{{ item.id }}.</span><img v-bind:src="item.icon"/><span>{{ item.name }}</span></a></div></div>',
	data() {
		return {
			source: []
		}
	},
	mounted(){
		var show = this; 
		axios.get(window.location.href+"include_php/Source.php").then(function(responce){
			show.source = responce.data
		});
	}
});