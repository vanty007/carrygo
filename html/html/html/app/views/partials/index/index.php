        <template id="Index">
         <div>

         <div class="page sub-page">
        <!--*********************************************************************************************************-->
        <!--************ HERO ***************************************************************************************-->
        <!--*********************************************************************************************************-->
        <section class="hero">
            <div class="hero-wrapper">
                <!--============ Secondary Navigation ===============================================================-->
                <div class="secondary-navigation">
              
                </div>
                <!--============ End Secondary Navigation ===========================================================-->
                <!--============ Main Navigation ====================================================================-->
                <div class="main-navigation">
                </div>
                <!--============ End Main Navigation ================================================================-->
                <!--============ End Hero Form ======================================================================-->
                <!--============ Page Title =========================================================================-->
                <div class="page-title">
                    <div class="container">
                        <h1>Homly</h1>
                    </div>
                    <!--end container-->
                </div>
                <!--============ End Page Title =====================================================================-->
                <div class="background"></div>
                <!--end background-->
            </div>
            <!--end hero-wrapper-->
        </section>
        <!--end hero-->

        <!--*********************************************************************************************************-->
        <!--************ CONTENT ************************************************************************************-->
        <!--*********************************************************************************************************-->
        <section class="content">
        <center><h1 >Sign In</h1></center>
            <section class="block">
                <div class="container">
                    <div class="row justify-content-center">
                    
                        <div class="col-md-4">
                            <form class="form clearfix" name="loginForm" action="<?php print_link('index/login'); ?>" @submit.prevent="login()" method="post">
                            <b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>
                                        {{errorMsg}}
                                        </b-alert>
                                <div class="form-group">
                                    <label for="email" class="col-form-label required">Email</label>
                                    <input placeholder="Username or email" v-model="user.username" name="username"  required="required" class="form-control" type="text" >
                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="password" class="col-form-label required">Password</label>
                                    <input placeholder="Password" required="required" v-model="user.password" name="password" class="form-control" type="password">
                                </div>
                                <!--end form-group-->
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <label>
                                        <input value="true" type="checkbox" name="rememberme" >
                                        Remember Me
                                    </label>
                                    <button class="btn btn-primary btn-block btn-md" type="submit">
                                                <i class="load-indicator">
                                                    <clip-loader :loading="loading" color="#fff" size="14px"></clip-loader>
                                                </i>
                                                Login <i class="fa fa-key"></i>
                                            </button>
                                </div>
                            </form>
                            <hr>
                            <p>
                                Troubles with signing? <a href="#" class="link">Click here.</a>
                            </p>
                        </div>
                        <!--end col-md-6-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--end block-->
        </section>
        <!--end content-->

    </div>
    <!--end page-->
    
        </div>
        </template>
        <script>
			var IndexComponent = Vue.component('IndexComponent', {
				template : '#Index',
				data : function() {
					return {
						user : {
							username : '',
							password : '',
						},
						loading : false,
						ready: false,
						errorMsg : '',
						showError : false,
					}
				},
				computed: {
					setGridSize: function(){
						if(this.resetgrid){
							return 'col-sm-12 col-md-12 col-lg-12';
						}
					}
				},
				methods : {
					login : function(e){
						var payload = this.user;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/login');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
						},
						function (response) {
							this.loading = false;
							this.showError = false
							this.errorMsg = response.statusText;
							//Flashes messages
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					}
				},
				mounted : function() {
					this.ready = true;
				},
			});
		</script>
