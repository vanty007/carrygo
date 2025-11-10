var bus = new Vue({});
var routes = [
  
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

	{ path: '/propertysearch', name: 'propertysearchlist', component: PropertysearchListComponent },
	{ path: '/propertysearch/(index|list)', name: 'propertysearchlist' , component: PropertysearchListComponent },
	{ path: '/propertysearch/(index|list)/:fieldname/:fieldvalue', name: 'propertysearchlist' , component: PropertysearchListComponent , props: true },

	{ path: '/home', name: 'home' , component: HomeComponent },
	//{ path: '/contact', name: 'contact' , component: ContactComponent },
	{ path: '*', name: 'pagenotfound' , component: ComponentNotFound }
];

if(!ActiveUser){
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
