var bus = new Vue({});
var routes = [
  
	{ path: '/', name: 'home' , component: HomeComponent },
	{ path: '/auth', name: 'authlist', component: AuthListComponent },
	{ path: '/auth/(index|list)', name: 'authlist' , component: AuthListComponent },
	{ path: '/auth/(index|list)/:fieldname/:fieldvalue', name: 'authlist' , component: AuthListComponent , props: true },
	{ path: '/auth/view/:id', name: 'authview' , component: AuthViewComponent , props: true},
	{ path: '/auth/view/:fieldname/:fieldvalue', name: 'authview' , component: AuthViewComponent , props: true },
	{ path: '/account/edit', name: 'accountedit' , component: AccountEditComponent },
	{ path: '/account', name: 'accountview' , component: AccountViewComponent },
	{ path: '/auth/add', name: 'authadd' , component: AuthAddComponent },
	{ path: '/auth/edit/:id' , name: 'authedit' , component: AuthEditComponent , props: true},
	{ path: '/auth/edit', name: 'authedit' , component: AuthEditComponent , props: true},

	{ path: '/chargetype', name: 'chargetypelist', component: ChargetypeListComponent },
	{ path: '/chargetype/(index|list)', name: 'chargetypelist' , component: ChargetypeListComponent },
	{ path: '/chargetype/(index|list)/:fieldname/:fieldvalue', name: 'chargetypelist' , component: ChargetypeListComponent , props: true },
	{ path: '/chargetype/view/:id', name: 'chargetypeview' , component: ChargetypeViewComponent , props: true},
	{ path: '/chargetype/view/:fieldname/:fieldvalue', name: 'chargetypeview' , component: ChargetypeViewComponent , props: true },
	{ path: '/chargetype/add', name: 'chargetypeadd' , component: ChargetypeAddComponent },
	{ path: '/chargetype/edit/:id' , name: 'chargetypeedit' , component: ChargetypeEditComponent , props: true},
	{ path: '/chargetype/edit', name: 'chargetypeedit' , component: ChargetypeEditComponent , props: true},

	{ path: '/facilitytype', name: 'facilitytypelist', component: FacilitytypeListComponent },
	{ path: '/facilitytype/(index|list)', name: 'facilitytypelist' , component: FacilitytypeListComponent },
	{ path: '/facilitytype/(index|list)/:fieldname/:fieldvalue', name: 'facilitytypelist' , component: FacilitytypeListComponent , props: true },
	{ path: '/facilitytype/view/:id', name: 'facilitytypeview' , component: FacilitytypeViewComponent , props: true},
	{ path: '/facilitytype/view/:fieldname/:fieldvalue', name: 'facilitytypeview' , component: FacilitytypeViewComponent , props: true },
	{ path: '/facilitytype/add', name: 'facilitytypeadd' , component: FacilitytypeAddComponent },
	{ path: '/facilitytype/edit/:id' , name: 'facilitytypeedit' , component: FacilitytypeEditComponent , props: true},
	{ path: '/facilitytype/edit', name: 'facilitytypeedit' , component: FacilitytypeEditComponent , props: true},

	{ path: '/propertyfacility', name: 'propertyfacilitylist', component: PropertyfacilityListComponent },
	{ path: '/propertyfacility/(index|list)', name: 'propertyfacilitylist' , component: PropertyfacilityListComponent },
	{ path: '/propertyfacility/(index|list)/:fieldname/:fieldvalue', name: 'propertyfacilitylist' , component: PropertyfacilityListComponent , props: true },
	{ path: '/propertyfacility/view/:id', name: 'propertyfacilityview' , component: PropertyfacilityViewComponent , props: true},
	{ path: '/propertyfacility/view/:fieldname/:fieldvalue', name: 'propertyfacilityview' , component: PropertyfacilityViewComponent , props: true },
	{ path: '/propertyfacility/add', name: 'propertyfacilityadd' , component: PropertyfacilityAddComponent },
	{ path: '/propertyfacility/edit/:id' , name: 'propertyfacilityedit' , component: PropertyfacilityEditComponent , props: true},
	{ path: '/propertyfacility/edit', name: 'propertyfacilityedit' , component: PropertyfacilityEditComponent , props: true},

	{ path: '/propertylist', name: 'propertylistlist', component: PropertylistListComponent },
	{ path: '/propertylist/(index|list)', name: 'propertylistlist' , component: PropertylistListComponent },
	{ path: '/propertylist/(index|list)/:fieldname/:fieldvalue', name: 'propertylistlist' , component: PropertylistListComponent , props: true },
	{ path: '/propertylist/view/:id', name: 'propertylistview' , component: PropertylistViewComponent , props: true},
	{ path: '/propertylist/view/:fieldname/:fieldvalue', name: 'propertylistview' , component: PropertylistViewComponent , props: true },
	{ path: '/propertylist/add', name: 'propertylistadd' , component: PropertylistAddComponent },
	{ path: '/propertylist/edit/:id' , name: 'propertylistedit' , component: PropertylistEditComponent , props: true},
	{ path: '/propertylist/edit', name: 'propertylistedit' , component: PropertylistEditComponent , props: true},

	{ path: '/propertylocations', name: 'propertylocationslist', component: PropertylocationsListComponent },
	{ path: '/propertylocations/(index|list)', name: 'propertylocationslist' , component: PropertylocationsListComponent },
	{ path: '/propertylocations/(index|list)/:fieldname/:fieldvalue', name: 'propertylocationslist' , component: PropertylocationsListComponent , props: true },
	{ path: '/propertylocations/view/:id', name: 'propertylocationsview' , component: PropertylocationsViewComponent , props: true},
	{ path: '/propertylocations/view/:fieldname/:fieldvalue', name: 'propertylocationsview' , component: PropertylocationsViewComponent , props: true },
	{ path: '/propertylocations/add', name: 'propertylocationsadd' , component: PropertylocationsAddComponent },
	{ path: '/propertylocations/edit/:id' , name: 'propertylocationsedit' , component: PropertylocationsEditComponent , props: true},
	{ path: '/propertylocations/edit', name: 'propertylocationsedit' , component: PropertylocationsEditComponent , props: true},

	{ path: '/propertytype', name: 'propertytypelist', component: PropertytypeListComponent },
	{ path: '/propertytype/(index|list)', name: 'propertytypelist' , component: PropertytypeListComponent },
	{ path: '/propertytype/(index|list)/:fieldname/:fieldvalue', name: 'propertytypelist' , component: PropertytypeListComponent , props: true },
	{ path: '/propertytype/view/:id', name: 'propertytypeview' , component: PropertytypeViewComponent , props: true},
	{ path: '/propertytype/view/:fieldname/:fieldvalue', name: 'propertytypeview' , component: PropertytypeViewComponent , props: true },
	{ path: '/propertytype/add', name: 'propertytypeadd' , component: PropertytypeAddComponent },
	{ path: '/propertytype/edit/:id' , name: 'propertytypeedit' , component: PropertytypeEditComponent , props: true},
	{ path: '/propertytype/edit', name: 'propertytypeedit' , component: PropertytypeEditComponent , props: true},

	{ path: '/rating', name: 'ratinglist', component: RatingListComponent },
	{ path: '/rating/(index|list)', name: 'ratinglist' , component: RatingListComponent },
	{ path: '/rating/(index|list)/:fieldname/:fieldvalue', name: 'ratinglist' , component: RatingListComponent , props: true },
	{ path: '/rating/view/:id', name: 'ratingview' , component: RatingViewComponent , props: true},
	{ path: '/rating/view/:fieldname/:fieldvalue', name: 'ratingview' , component: RatingViewComponent , props: true },
	{ path: '/rating/add', name: 'ratingadd' , component: RatingAddComponent },
	{ path: '/rating/edit/:id' , name: 'ratingedit' , component: RatingEditComponent , props: true},
	{ path: '/rating/edit', name: 'ratingedit' , component: RatingEditComponent , props: true},

	{ path: '/user', name: 'userlist', component: UserListComponent },
	{ path: '/user/(index|list)', name: 'userlist' , component: UserListComponent },
	{ path: '/user/(index|list)/:fieldname/:fieldvalue', name: 'userlist' , component: UserListComponent , props: true },
	{ path: '/user/view/:id', name: 'userview' , component: UserViewComponent , props: true},
	{ path: '/user/view/:fieldname/:fieldvalue', name: 'userview' , component: UserViewComponent , props: true },
	{ path: '/user/add', name: 'useradd' , component: UserAddComponent },
	{ path: '/user/edit/:id' , name: 'useredit' , component: UserEditComponent , props: true},
	{ path: '/user/edit', name: 'useredit' , component: UserEditComponent , props: true},

	{ path: '/propertygallery', name: 'propertygallerylist', component: PropertygalleryListComponent },
	{ path: '/propertygallery/(index|list)', name: 'propertygallerylist' , component: PropertygalleryListComponent },
	{ path: '/propertygallery/(index|list)/:fieldname/:fieldvalue', name: 'propertygallerylist' , component: PropertygalleryListComponent , props: true },
	{ path: '/propertygallery/view/:id', name: 'propertygalleryview' , component: PropertygalleryViewComponent , props: true},
	{ path: '/propertygallery/view/:fieldname/:fieldvalue', name: 'propertygalleryview' , component: PropertygalleryViewComponent , props: true },
	{ path: '/propertygallery/add', name: 'propertygalleryadd' , component: PropertygalleryAddComponent },
	{ path: '/propertygallery/edit/:id' , name: 'propertygalleryedit' , component: PropertygalleryEditComponent , props: true},
	{ path: '/propertygallery/edit', name: 'propertygalleryedit' , component: PropertygalleryEditComponent , props: true},

	{ path: '/propertyavailability', name: 'propertyavailabilitylist', component: PropertyavailabilityListComponent },
	{ path: '/propertyavailability/(index|list)', name: 'propertyavailabilitylist' , component: PropertyavailabilityListComponent },
	{ path: '/propertyavailability/(index|list)/:fieldname/:fieldvalue', name: 'propertyavailabilitylist' , component: PropertyavailabilityListComponent , props: true },
	{ path: '/propertyavailability/view/:id', name: 'propertyavailabilityview' , component: PropertyavailabilityViewComponent , props: true},
	{ path: '/propertyavailability/view/:fieldname/:fieldvalue', name: 'propertyavailabilityview' , component: PropertyavailabilityViewComponent , props: true },
	{ path: '/propertyavailability/add', name: 'propertyavailabilityadd' , component: PropertyavailabilityAddComponent },
	{ path: '/propertyavailability/edit/:id' , name: 'propertyavailabilityedit' , component: PropertyavailabilityEditComponent , props: true},
	{ path: '/propertyavailability/edit', name: 'propertyavailabilityedit' , component: PropertyavailabilityEditComponent , props: true},

	{ path: '/propertypart', name: 'propertypartlist', component: PropertypartListComponent },
	{ path: '/propertypart/(index|list)', name: 'propertypartlist' , component: PropertypartListComponent },
	{ path: '/propertypart/(index|list)/:fieldname/:fieldvalue', name: 'propertypartlist' , component: PropertypartListComponent , props: true },
	{ path: '/propertypart/view/:id', name: 'propertypartview' , component: PropertypartViewComponent , props: true},
	{ path: '/propertypart/view/:fieldname/:fieldvalue', name: 'propertypartview' , component: PropertypartViewComponent , props: true },
	{ path: '/propertypart/add', name: 'propertypartadd' , component: PropertypartAddComponent },
	{ path: '/propertypart/edit/:id' , name: 'propertypartedit' , component: PropertypartEditComponent , props: true},
	{ path: '/propertypart/edit', name: 'propertypartedit' , component: PropertypartEditComponent , props: true},

	{ path: '/propertyreservation', name: 'propertyreservationlist', component: PropertyreservationListComponent },
	{ path: '/propertyreservation/(index|list)', name: 'propertyreservationlist' , component: PropertyreservationListComponent },
	{ path: '/propertyreservation/(index|list)/:fieldname/:fieldvalue', name: 'propertyreservationlist' , component: PropertyreservationListComponent , props: true },
	{ path: '/propertyreservation/view/:id', name: 'propertyreservationview' , component: PropertyreservationViewComponent , props: true},
	{ path: '/propertyreservation/view/:fieldname/:fieldvalue', name: 'propertyreservationview' , component: PropertyreservationViewComponent , props: true },
	{ path: '/propertyreservation/add', name: 'propertyreservationadd' , component: PropertyreservationAddComponent },
	{ path: '/propertyreservation/edit/:id' , name: 'propertyreservationedit' , component: PropertyreservationEditComponent , props: true},
	{ path: '/propertyreservation/edit', name: 'propertyreservationedit' , component: PropertyreservationEditComponent , props: true},

	{ path: '/myreservation', name: 'myreservationlist', component: MyreservationListComponent },
	{ path: '/myreservation/(index|list)', name: 'myreservationlist' , component: MyreservationListComponent },
	{ path: '/myreservation/(index|list)/:fieldname/:fieldvalue', name: 'myreservationlist' , component: MyreservationListComponent , props: true },
	{ path: '/myreservation/view/:id', name: 'myreservationview' , component: MyreservationViewComponent , props: true},
	{ path: '/myreservation/view/:fieldname/:fieldvalue', name: 'myreservationview' , component: MyreservationViewComponent , props: true },

	{ path: '/propertysearch', name: 'propertysearchlist', component: PropertysearchListComponent },
	{ path: '/propertysearch/(index|list)', name: 'propertysearchlist' , component: PropertysearchListComponent },
	{ path: '/propertysearch/(index|list)/:fieldname/:fieldvalue', name: 'propertysearchlist' , component: PropertysearchListComponent , props: true },

	{ path: '/dashboard', name: 'dashboardlist', component: DashboardListComponent },
	{ path: '/dashboard/(index|list)', name: 'dashboardlist' , component: DashboardListComponent },
	{ path: '/dashboard/(index|list)/:fieldname/:fieldvalue', name: 'dashboardlist' , component: DashboardListComponent , props: true },
	
	{ path: '/bookings', name: 'bookingslist', component: BookingsListComponent },
	{ path: '/bookings/(index|list)', name: 'bookingslist' , component: BookingsListComponent },
	{ path: '/bookings/(index|list)/:fieldname/:fieldvalue', name: 'bookingslist' , component: BookingsListComponent , props: true },

	{ path: '/payments', name: 'paymentslist', component: PaymentsListComponent },
	{ path: '/payments/(index|list)', name: 'paymentslist' , component: PaymentsListComponent },
	{ path: '/payments/(index|list)/:fieldname/:fieldvalue', name: 'paymentslist' , component: PaymentsListComponent , props: true },
	{ path: '/payments/view/:id', name: 'paymentsview' , component: PaymentsViewComponent , props: true},
	{ path: '/payments/view/:fieldname/:fieldvalue', name: 'paymentsview' , component: PaymentsViewComponent , props: true },
	{ path: '/payments/add', name: 'paymentsadd' , component: PaymentsAddComponent },
	{ path: '/payments/edit/:id' , name: 'paymentsedit' , component: PaymentsEditComponent , props: true},
	{ path: '/payments/edit', name: 'paymentsedit' , component: PaymentsEditComponent , props: true},
	
	{ path: '/myfavourite', name: 'myfavouritelist', component: MyfavouriteListComponent },
	{ path: '/myfavourite/(index|list)', name: 'myfavouritelist' , component: MyfavouriteListComponent },
	{ path: '/myfavourite/(index|list)/:fieldname/:fieldvalue', name: 'myfavouritelist' , component: MyfavouriteListComponent , props: true },

	{ path: '/owner', name: 'ownerlist', component: OwnerListComponent },
	{ path: '/owner/(index|list)', name: 'ownerlist' , component: OwnerListComponent },
	{ path: '/owner/(index|list)/:fieldname/:fieldvalue', name: 'ownerlist' , component: OwnerListComponent , props: true },
	{ path: '/owner/view/:id', name: 'ownerview' , component: OwnerViewComponent , props: true},
	{ path: '/owner/view/:fieldname/:fieldvalue', name: 'ownerview' , component: OwnerViewComponent , props: true },
	{ path: '/owner/add', name: 'owneradd' , component: OwnerAddComponent },
	{ path: '/owner/edit/:id' , name: 'owneredit' , component: OwnerEditComponent , props: true},
	{ path: '/owner/edit', name: 'owneredit' , component: OwnerEditComponent , props: true},

	{ path: '/message', name: 'messagelist', component: MessageListComponent },
	{ path: '/message/(index|list)', name: 'messagelist' , component: MessageListComponent },
	{ path: '/message/(index|list)/:fieldname/:fieldvalue', name: 'messagelist' , component: MessageListComponent , props: true },
	{ path: '/message/view/:id', name: 'messageview' , component: MessageViewComponent , props: true},
	{ path: '/message/view/:fieldname/:fieldvalue', name: 'messageview' , component: MessageViewComponent , props: true },

	{ path: '/messages', name: 'messageslist', component: MessagesListComponent },
	{ path: '/messages/(index|list)', name: 'messageslist' , component: MessagesListComponent },
	{ path: '/messages/(index|list)/:fieldname/:fieldvalue', name: 'messageslist' , component: MessagesListComponent , props: true },
	{ path: '/messages/view/:id', name: 'messagesview' , component: MessagesViewComponent , props: true},
	{ path: '/messages/view/:fieldname/:fieldvalue', name: 'messagesview' , component: MessagesViewComponent , props: true },

	{ path: '/payment', name: 'paymentlist', component: PaymentListComponent },
	{ path: '/payment/(index|list)', name: 'paymentlist' , component: PaymentListComponent },
	{ path: '/payment/(index|list)/:fieldname/:fieldvalue', name: 'paymentlist' , component: PaymentListComponent , props: true },
	
	{ path: '/review', name: 'reviewlist', component: ReviewListComponent },
	{ path: '/review/(index|list)', name: 'reviewlist' , component: ReviewListComponent },
	{ path: '/review/(index|list)/:fieldname/:fieldvalue', name: 'reviewlist' , component: ReviewListComponent , props: true },

	{ path: '/propertyreport', name: 'propertyreportlist', component: PropertyreportListComponent },
	{ path: '/propertyreport/(index|list)', name: 'propertyreportlist' , component: PropertyreportListComponent },
	{ path: '/propertyreport/(index|list)/:fieldname/:fieldvalue', name: 'propertyreportlist' , component: PropertyreportListComponent , props: true },

	{ path: '/propertyrevenue', name: 'propertyrevenuelist', component: PropertyrevenueListComponent },
	{ path: '/propertyrevenue/(index|list)', name: 'propertyrevenuelist' , component: PropertyrevenueListComponent },
	{ path: '/propertyrevenue/(index|list)/:fieldname/:fieldvalue', name: 'propertyrevenuelist' , component: PropertyrevenueListComponent , props: true },

	{ path: '/propertyoccupancy', name: 'propertyoccupancylist', component: PropertyoccupancyListComponent },
	{ path: '/propertyoccupancy/(index|list)', name: 'propertyoccupancylist' , component: PropertyoccupancyListComponent },
	{ path: '/propertyoccupancy/(index|list)/:fieldname/:fieldvalue', name: 'propertyoccupancylist' , component: PropertyoccupancyListComponent , props: true },

	{ path: '/propertymaintenance', name: 'propertymaintenancelist', component: PropertymaintenanceListComponent },
	{ path: '/propertymaintenance/(index|list)', name: 'propertymaintenancelist' , component: PropertymaintenanceListComponent },
	{ path: '/propertymaintenance/(index|list)/:fieldname/:fieldvalue', name: 'propertymaintenancelist' , component: PropertymaintenanceListComponent , props: true },
	{ path: '/propertymaintenance/edit/:id' , name: 'propertymaintenanceedit' , component: PropertymaintenanceEditEditComponent , props: true},
	{ path: '/propertymaintenance/edit', name: 'propertymaintenanceedit' , component: PropertymaintenanceEditEditComponent , props: true},

	{ path: '/propertysoa', name: 'propertysoalist', component: PropertysoaListComponent },
	{ path: '/propertysoa/(index|list)', name: 'propertysoalist' , component: PropertysoaListComponent },
	{ path: '/propertysoa/(index|list)/:fieldname/:fieldvalue', name: 'propertysoalist' , component: PropertysoaListComponent , props: true },


	{ path: '/login', name: 'Login', component: LoginComponent },
	{ path: '/home', name: 'home' , component: HomeComponent },
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
			if(this.$route.name != 'index'){
				window.location = "#/login"
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
