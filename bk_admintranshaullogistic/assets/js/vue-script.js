var bus = new Vue({});
var routes = [
  
	{ path: '/delivery_option', name: 'delivery_optionlist', component: Delivery_OptionListComponent },
	{ path: '/delivery_option/(index|list)', name: 'delivery_optionlist' , component: Delivery_OptionListComponent },
	{ path: '/delivery_option/(index|list)/:fieldname/:fieldvalue', name: 'delivery_optionlist' , component: Delivery_OptionListComponent , props: true },
	{ path: '/delivery_option/view/:id', name: 'delivery_optionview' , component: Delivery_OptionViewComponent , props: true},
	{ path: '/delivery_option/view/:fieldname/:fieldvalue', name: 'delivery_optionview' , component: Delivery_OptionViewComponent , props: true },
	{ path: '/delivery_option/add', name: 'delivery_optionadd' , component: Delivery_OptionAddComponent },
	{ path: '/delivery_option/edit/:id' , name: 'delivery_optionedit' , component: Delivery_OptionEditComponent , props: true},
	{ path: '/delivery_option/edit', name: 'delivery_optionedit' , component: Delivery_OptionEditComponent , props: true},

	{ path: '/pickup_request', name: 'pickup_requestlist', component: Pickup_RequestListComponent },
	{ path: '/pickup_request/(index|list)', name: 'pickup_requestlist' , component: Pickup_RequestListComponent },
	{ path: '/pickup_request/(index|list)/:fieldname/:fieldvalue', name: 'pickup_requestlist' , component: Pickup_RequestListComponent , props: true },
	{ path: '/pickup_request/view/:id', name: 'pickup_requestview' , component: Pickup_RequestViewComponent , props: true},
	{ path: '/pickup_request/view/:fieldname/:fieldvalue', name: 'pickup_requestview' , component: Pickup_RequestViewComponent , props: true },
	{ path: '/pickup_request/add', name: 'pickup_requestadd' , component: Pickup_RequestAddComponent },
	{ path: '/pickup_request/edit/:id' , name: 'pickup_requestedit' , component: Pickup_RequestEditComponent , props: true},
	{ path: '/pickup_request/edit', name: 'pickup_requestedit' , component: Pickup_RequestEditComponent , props: true},

	{ path: '/riders_availability', name: 'riders_availabilitylist', component: Riders_AvailabilityListComponent },
	{ path: '/riders_availability/(index|list)', name: 'riders_availabilitylist' , component: Riders_AvailabilityListComponent },
	{ path: '/riders_availability/(index|list)/:fieldname/:fieldvalue', name: 'riders_availabilitylist' , component: Riders_AvailabilityListComponent , props: true },
	{ path: '/riders_availability/view/:id', name: 'riders_availabilityview' , component: Riders_AvailabilityViewComponent , props: true},
	{ path: '/riders_availability/view/:fieldname/:fieldvalue', name: 'riders_availabilityview' , component: Riders_AvailabilityViewComponent , props: true },
	{ path: '/riders_availability/add', name: 'riders_availabilityadd' , component: Riders_AvailabilityAddComponent },
	{ path: '/riders_availability/edit/:id' , name: 'riders_availabilityedit' , component: Riders_AvailabilityEditComponent , props: true},
	{ path: '/riders_availability/edit', name: 'riders_availabilityedit' , component: Riders_AvailabilityEditComponent , props: true},

	{ path: '/user', name: 'userlist', component: UserListComponent },
	{ path: '/user/(index|list)', name: 'userlist' , component: UserListComponent },
	{ path: '/user/(index|list)/:fieldname/:fieldvalue', name: 'userlist' , component: UserListComponent , props: true },
	{ path: '/user/view/:id', name: 'userview' , component: UserViewComponent , props: true},
	{ path: '/user/view/:fieldname/:fieldvalue', name: 'userview' , component: UserViewComponent , props: true },
	{ path: '/account/edit', name: 'accountedit' , component: AccountEditComponent },
	{ path: '/account', name: 'accountview' , component: AccountViewComponent },
	{ path: '/user/add', name: 'useradd' , component: UserAddComponent },
	{ path: '/user/edit/:id' , name: 'useredit' , component: UserEditComponent , props: true},
	{ path: '/user/edit', name: 'useredit' , component: UserEditComponent , props: true},

	{ path: '/pendingpickups', name: 'pendingpickupslist', component: PendingpickupsListComponent },
	{ path: '/pendingpickups/(index|list)', name: 'pendingpickupslist' , component: PendingpickupsListComponent },
	{ path: '/pendingpickups/(index|list)/:fieldname/:fieldvalue', name: 'pendingpickupslist' , component: PendingpickupsListComponent , props: true },

	{ path: '/trackitems', name: 'trackitemslist', component: TrackitemsListComponent },
	{ path: '/trackitems/(index|list)', name: 'trackitemslist' , component: TrackitemsListComponent },
	{ path: '/trackitems/(index|list)/:fieldname/:fieldvalue', name: 'trackitemslist' , component: TrackitemsListComponent , props: true },

	{ path: '/review', name: 'reviewlist', component: ReviewListComponent },
	{ path: '/review/(index|list)', name: 'reviewlist' , component: ReviewListComponent },
	{ path: '/review/(index|list)/:fieldname/:fieldvalue', name: 'reviewlist' , component: ReviewListComponent , props: true },
	{ path: '/review/view/:id', name: 'reviewview' , component: ReviewViewComponent , props: true},
	{ path: '/review/view/:fieldname/:fieldvalue', name: 'reviewview' , component: ReviewViewComponent , props: true },
	{ path: '/review/add', name: 'reviewadd' , component: ReviewAddComponent },
	{ path: '/review/edit/:id' , name: 'reviewedit' , component: ReviewEditComponent , props: true},
	{ path: '/review/edit', name: 'reviewedit' , component: ReviewEditComponent , props: true},

	{ path: '/payments', name: 'paymentslist', component: PaymentsListComponent },
	{ path: '/payments/(index|list)', name: 'paymentslist' , component: PaymentsListComponent },
	{ path: '/payments/(index|list)/:fieldname/:fieldvalue', name: 'paymentslist' , component: PaymentsListComponent , props: true },
	{ path: '/payments/view/:id', name: 'paymentsview' , component: PaymentsViewComponent , props: true},
	{ path: '/payments/view/:fieldname/:fieldvalue', name: 'paymentsview' , component: PaymentsViewComponent , props: true },
	{ path: '/payments/add', name: 'paymentsadd' , component: PaymentsAddComponent },
	{ path: '/payments/edit/:id' , name: 'paymentsedit' , component: PaymentsEditComponent , props: true},
	{ path: '/payments/edit', name: 'paymentsedit' , component: PaymentsEditComponent , props: true},

	{ path: '/home', name: 'home' , component: HomeComponent },
	{ path: '*', name: 'pagenotfound' , component: ComponentNotFound }
];

if(ActiveUser){
	routes.push({ path: '/', name: 'home' , component: HomeComponent })
}
else{
	routes.push({ path: '/', name: 'index', component: IndexComponent })
	routes.push({ path: '/register', name: 'register', component: RegisterComponent })
}

var router = new VueRouter({
	routes:routes,
	linkExactActiveClass:'active',
	linkActiveClass:'active',
	//mode:'history'
});
router.beforeEach(function(to, from, next) {
	document.body.className = to.name;
	
	if(to.name !='index' && to.name !='register' && !ActiveUser){
		next(
			{
				path: '/' , 
				query:{
					redirect:to.path 
				}
			}
		);
	}
	else{
		next();	
	}

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
			if(this.$route.name != 'index'){
				window.location = "/"
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
