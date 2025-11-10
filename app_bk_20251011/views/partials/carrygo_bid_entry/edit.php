    <template id="carrygo_bid_entryEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Carrygo Bid Entry</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var Carrygo_Bid_EntryEditComponent = Vue.component('carrygo_bid_entryEdit', {
		template : '#carrygo_bid_entryEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'carrygo_bid_entry',
			},
			routename : {
				type : String,
				default : 'carrygo_bid_entryedit',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid_entry/edit',
			},
		},
		data: function() {
			return {
				data : { id: '',msisdn: '',bidid: '',points: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Carrygo Bid Entry';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/carrygo_bid_entry');
				}
			},
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
				}
			},
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.data[key]= binds[key];
				}
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted: function() {
			//this.load();
		},
	});
	</script>
