var bus = new Vue({});
var routes = [

	{ path: '/', name: 'home' , component: HomeComponent },
	{ path: '/(index|list)/:fieldname/:fieldvalue', name: 'home' , component: HomeComponent , props: true },
	{ path: '/propertylist', name: 'propertylistlist', component: PropertylistListComponent },
	{ path: '/propertylist/(index|list)', name: 'propertylistlist' , component: PropertylistListComponent },
	{ path: '/propertylist/(index|list)/:fieldname/:fieldvalue', name: 'propertylistlist' , component: PropertylistListComponent , props: true },
	{ path: '/propertylist/view/:id', name: 'propertylistview' , component: PropertylistViewComponent , props: true},
	{ path: '/propertylist/view/:fieldname/:fieldvalue', name: 'propertylistview' , component: PropertylistViewComponent , props: true },
	{ path: '/propertylist/add', name: 'propertylistadd' , component: PropertylistAddComponent },
	{ path: '/propertylist/edit/:id' , name: 'propertylistedit' , component: PropertylistEditComponent , props: true},
	{ path: '/propertylist/edit', name: 'propertylistedit' , component: PropertylistEditComponent , props: true},

	{ path: '/propertysearch', name: 'propertysearchlist', component: PropertysearchListComponent },
	{ path: '/propertysearch/(index|list)', name: 'propertysearchlist' , component: PropertysearchListComponent },
	{ path: '/propertysearch/(index|list)/:fieldname/:fieldvalue', name: 'propertysearchlist' , component: PropertysearchListComponent , props: true },

	{ path: '/bid', name: 'bidlist', component: BidListComponent },
	{ path: '/bid/(index|list)', name: 'bidlist' , component: BidListComponent },
	{ path: '/bid/(index|list)/:fieldname/:fieldvalue', name: 'bidlist' , component: BidListComponent , props: true },
	{ path: '/bid/view/:id', name: 'bidview' , component: BidViewComponent , props: true},
	{ path: '/bid/view/:fieldname/:fieldvalue', name: 'bidview' , component: BidViewComponent , props: true },

	{ path: '/trending', name: 'trendinglist', component: TrendingListComponent },
	{ path: '/trending/(index|list)', name: 'trendinglist' , component: TrendingListComponent },
	{ path: '/trending/(index|list)/:fieldname/:fieldvalue', name: 'trendinglist' , component: TrendingListComponent , props: true },

	{ path: '/openbid', name: 'openbidlist', component: OpenbidListComponent },
	{ path: '/openbid/(index|list)', name: 'openbidlist' , component: OpenbidListComponent },
	{ path: '/openbid/(index|list)/:fieldname/:fieldvalue', name: 'openbidlist' , component: OpenbidListComponent , props: true },

	{ path: '/mybids', name: 'mybidslist', component: MybidsListComponent },
	{ path: '/mybids/(index|list)', name: 'mybidslist' , component: MybidsListComponent },
	{ path: '/mybids/(index|list)/:fieldname/:fieldvalue', name: 'mybidslist' , component: MybidsListComponent , props: true },

	{ path: '/mybidswon', name: 'mybidswonlist', component: MybidswonListComponent },
	{ path: '/mybidswon/(index|list)', name: 'mybidswonlist' , component: MybidswonListComponent },
	{ path: '/mybidswon/(index|list)/:fieldname/:fieldvalue', name: 'mybidswonlist' , component: MybidswonListComponent , props: true },

	{ path: '/winnersbid', name: 'winnersbidlist', component: WinnersbidListComponent },
	{ path: '/winnersbid/(index|list)', name: 'winnersbidlist' , component: WinnersbidListComponent },
	{ path: '/winnersbid/(index|list)/:fieldname/:fieldvalue', name: 'winnersbidlist' , component: WinnersbidListComponent , props: true },

	{ path: '/leaderboard', name: 'leaderboardlist', component: LeaderboardListComponent },
	{ path: '/leaderboard/(index|list)', name: 'leaderboardlist' , component: LeaderboardListComponent },
	{ path: '/leaderboard/(index|list)/:fieldname/:fieldvalue', name: 'leaderboardlist' , component: LeaderboardListComponent , props: true },

	{ path: '/leaderboardbid', name: 'leaderboardbidlist', component: LeaderboardbidListComponent },
	{ path: '/leaderboardbid/(index|list)', name: 'leaderboardbidlist' , component: LeaderboardbidListComponent },
	{ path: '/leaderboardbid/(index|list)/:fieldname/:fieldvalue', name: 'leaderboardbidlist' , component: LeaderboardbidListComponent , props: true },

	/*{ path: '/bidleads', name: 'bidleadslist', component: bidleadsListComponent },
	{ path: '/bidleads/(index|list)', name: 'bidleadslist' , component: bidleadsListComponent },
	{ path: '/bidleads/(index|list)/:fieldname/:fieldvalue', name: 'bidleadslist' , component: bidleadsListComponent , props: true },*/

	{ path: '/login', name: 'Login', component: LoginComponent },
	{ path: '/home', name: 'home' , component: HomeComponent },
	{ path: '/home/(index|list)/:fieldname/:fieldvalue', name: 'home' , component: HomeComponent , props: true },
	//{ path: '/contact', name: 'contact' , component: ContactComponent },
	{ path: '*', name: 'pagenotfound' , component: ComponentNotFound }
];

var router = new VueRouter({
	routes:routes,
	linkExactActiveClass:'active',
	linkActiveClass:'active',
	//mode:'history'
});
router.beforeEach(function(to, from, next) {
	document.body.className = to.name;
	
	next();

});
var config = {
	errorBagName: 'errors', // change if property conflicts
	fieldsBagName: 'fields', 
	delay: 0, 
	locale: '', 
	dictionary: null, 
	strict: true, 
	classes: false, 
	classNames: {
		touched: 'touched', // the control has been blurred
		untouched: 'untouched', // the control hasn't been blurred
		valid: 'valid', // model is valid
		invalid: 'invalid', // model is invalid
		pristine: 'pristine', // control has not been interacted with
		dirty: 'dirty' // control has been interacted with
	},
	events: 'input|blur',
	inject: true,
	validity: false,
	aria: true,
	i18n: null, // the vue-i18n plugin instance,
	i18nRootKey: 'validations', // the nested key under which the validation messsages will be located
};

Vue.use(VeeValidate,config);
Vue.http.interceptors.push(function(request, next) {
	next(function(response){
		if(response.status == 401 ) {
			if(this.$route.name != 'login'){
				window.location = "#login"
				//window.location = ""
				//this.$router.push('index');
			}
		}
		else if(response.status == 403 ) {
			alert(response.statusText);
			window.location = 'errors/forbidden';
		}
	});
});
Vue.mixin({
	data: function() {
		return {
			get ActiveUser() {
				return ActiveUser
			}
		}
	},
	methods: {
		SetPageTitle: function(title, pagename){
			document.title = title;
		},
		setPhotoUrl: function(src, width,height){
			var newSrc = 'helpers/timthumb.php?src=' + src;
			if(width){
				newSrc = newSrc + '&w=' + width
			}
			if(height){
				newSrc = newSrc + '&h=' + height	
			}
			return  newSrc;
		},
		exportPage: function(pagehtml , reporttitle){
			var form = document.getElementById("exportform");
			document.getElementById("exportformdata").value = pagehtml ;
			document.getElementById("exportformtitle").value = reporttitle ;
			form.submit();
		}
	}
});

var app = new Vue({
	el: '#app',
	router: router,
	data:{
		message: 'This is Global Variable ',
		gVar: 'kkk',
		showPageError : false,
		pageErrorMsg : '',
		pageErrorStatus : '',
		modalComponentName: '',
		modalComponentProps: '',
		popoverTarget : '',
		showModalView : false,
		showFlash : false,
		flashMsg : '',
	},
	watch : {
		'$route': function(){
			this.pageErrorMsg = '' ;
			this.showPageError = false ;
		},
	},
	mounted : function(){
		this.$on('requestCompleted' ,  function (msg) {
			this.showModal = false;
			if(msg){
				this.showFlash = 3 ;
				this.flashMsg = msg ;
			}
			bus.$emit('refresh');
		});
		this.$on('requestError' ,  function (response) {
			this.pageErrorMsg = response.bodyText ;
			this.pageErrorStatus = response.statusText ;
			this.showPageError = true ;
		})
		
		this.$on('showPageModal' ,  function (props) {
			if(props.page){
				this.modalComponentName = props.page;
				delete props.page;
				props.resetgrid = true; // reset columns so that page components will fit well
				this.modalComponentProps = props;
				this.showModalView = true;
			}
			else{
				console.error("No Page Defined")
			}
		})
		
		this.$on('showPopOver' ,  function (props) {
			if(props.page && props.target){
				this.modalComponentName = props.page;
				this.popoverTarget = props.target;
				delete props.page;
				delete props.target;
				props.resetgrid=true;
				this.modalComponentProps = props;
			}
			else{
				console.error("No Page or Target  Defined")
			}
		})
		
		this.$on('showListModal' ,  function (arr) {
			this.modalComponentName = arr[0];
			this.modalFieldName = arr[1];
			this.modalFieldValue = arr[2];
			this.showModalList = true;
		})
	}
});

Vue.filter('toUSD', function (value) {
	return '$'+ value;
});
Vue.filter('upper', function (value) {
	return value.toUpperCase();
});
Vue.filter('lower', function (value) {
	return value.toLowerCase();
});
Vue.filter('proper', function (value) {
	return value.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
});
Vue.filter('truncate', function (text, length, suffix) {
	return text.substring(0, length) + suffix;
});
Vue.filter('toFixed', function (price, limit) {
	return price.toFixed(limit);
});
Vue.filter('makeRead', function (str) {
	return str.replace(/[-_]/g, " ");
});
Vue.filter('humanDate', function (datestr) {
	var timeStamp = new Date(datestr);
	return timeStamp.toDateString();
});
Vue.filter('humanTime', function (datestr) {
	var timeStamp = new Date(datestr);
	return timeStamp.toLocaleTimeString();
});

Vue.filter('toLocaleString', function (val) {
	return val.toLocaleString();
});
