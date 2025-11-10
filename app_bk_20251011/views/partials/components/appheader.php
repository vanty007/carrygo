<?php 
	
	$navbartopleft=array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'auth', 
			'label' => 'Auth', 
			'icon' => ''
		),
		
		array(
			'path' => 'chargetype', 
			'label' => 'Chargetype', 
			'icon' => ''
		),
		
		array(
			'path' => 'facilitytype', 
			'label' => 'Facilitytype', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertyfacility', 
			'label' => 'Propertyfacility', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertylist', 
			'label' => 'Propertylist', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertylocations', 
			'label' => 'Propertylocations', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertytype', 
			'label' => 'Propertytype', 
			'icon' => ''
		),
		
		array(
			'path' => 'rating', 
			'label' => 'Rating', 
			'icon' => ''
		),
		
		array(
			'path' => 'user', 
			'label' => 'User', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertygallery', 
			'label' => 'Propertygallery', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertyavailability', 
			'label' => 'Propertyavailability', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertypart', 
			'label' => 'Propertypart', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertyreservation', 
			'label' => 'Propertyreservation', 
			'icon' => ''
		),
		
		array(
			'path' => 'myreservation', 
			'label' => 'Myreservation', 
			'icon' => ''
		),
		
		array(
			'path' => 'propertysearch', 
			'label' => 'Propertysearch', 
			'icon' => ''
		)
	);

		
	
?>
<template id="AppHeader">
	<header id="header-container">
		<!-- Header -->
		<div id="header">
			<div class="container">
				<!-- Left Side Content -->
				<div class="left-side">
					<!-- Logo -->
					<div id="logo">
						<a style="cursor: pointer;" href="#"><img src="libb/assets/images/logo.png" alt=""></a>
					</div>

					<!-- Mobile Navigation -->
					<div class="mmenu-trigger">
						<button class="hamburger hamburger--collapse" type="button">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</button>
					</div>

					<!-- Main Navigation -->
					<nav id="navigation" class="style-1">
						<ul id="responsive" >
							<li onclick="fhome()" class="current"><a style="cursor: pointer;">Home</a></li>
							<li onclick="ftrendingitems()"><a style="cursor: pointer;">Trending Items</a></li>
							<li onclick="fopenbids()" ><a style="cursor: pointer;">Open Bids</a></li>
							<li onclick="fwinnersbids()" ><a style="cursor: pointer;">History of Bids Won</a></li>
							<li onclick="fleaderboardbids()" ><a style="cursor: pointer;">Leaderboard</a></li>
						</ul>
					</nav>
					<div class="clearfix"></div>
					<!-- Main Navigation / End -->	
				</div>
				<!-- Left Side Content / End -->

				<!-- Right Side Content / End -->
				<div class="right-side">
					<div class="header-widget">
						<!-- User Menu -->
						<div class="user-menu">
							<div class="user-name"><span><img src="libb/assets/images/avatar_user.png" alt="">My Points <?php echo USER_POINTS ?></span></div>
								<ul>
									<li onclick="fmybids()"><a style="cursor: pointer;"><i class="sl sl-icon-wallet"></i>My Bids</a></li>
									<li onclick="fmybidswon()"><a style="cursor: pointer;"><i class="sl sl-icon-wallet"></i>My Bids Won</a></li>
									<!--<?php 
									if(user_login_status() == true){
									?>
									<li onclick="fmybids()"><a style="cursor: pointer;"><i class="sl sl-icon-wallet"></i>My Bids</a></li>
									<?php
									}
									else {
									?>
									<li><a href="#login" ><i class="sl sl-icon-user"></i> Get Points / Login</a></li>
									<?php
									}
									?>-->
									
								</ul>
							</div>
						</div>
					</div>
				</div>		
				<!-- Right Side Content / End -->
			</div>
		</div>
		<!-- Header / End -->
	</header>
<!-- Header Container / End -->
</template>

<script>
	var AppHeader = Vue.component('AppHeader', {
		template:'#AppHeader',
		mounted:function(){
			//let height = this.$el.offsetHeight;
			if(this.$refs.navbar){
				var height = this.$refs.navbar.offsetHeight;
				document.body.style.paddingTop = height + 'px';
				
				if(this.$refs.sidebar){
					this.$refs.sidebar.style.top = height + 'px';
				}
			}
		}
	})
</script>

<?php
	/**
	 * Build Menu List From Array
	 * Support Multi Level Dropdown Menu Tree
	 * Set Active Menu Base on The Current Page || url
	 * @return  HTML
	 */
	function render_menu($arrMenu,$slot="left"){
		if(!empty($arrMenu)){
			foreach($arrMenu as $menuobj){
				$path = trim($menuobj['path'],"/");
				
				if(PageAccessManager::GetPageAccess($path)=='AUTHORIZED'){

					if(empty($menuobj['submenu'])){
						?>
						<b-nav-item to="/<?php echo ($path); ?>">
							<?php echo (!empty($menuobj['icon']) ? $menuobj['icon'] : null); ?> 
							<?php echo $menuobj['label']; ?>
						</b-nav-item>
						<?php
					}
					else{
						$smenu=$menuobj['submenu'];
						?>
						<b-nav-item-dropdown right>
							<template slot="button-content">
								<?php echo (!empty($menuobj['icon']) ? $menuobj['icon'] : null); ?> 
								<?php echo $menuobj['label']; ?>
								<?php if(!empty($smenu)){ ?><i class="caret"></i><?php } ?>
							</template>
							<?php
								if(!empty($smenu)){
									 render_submenu($smenu);
								}
							?>
						</b-nav-item-dropdown>
						<?php 
					}
				}
			}
		
		}
	}
	
	/**
	 * Render Multi Level Dropdown menu 
	 * Recursive Function
	 * @return  HTML
	 */
	function render_submenu($arrMenu){
		if(!empty($arrMenu)){
			foreach($arrMenu as $key=>$menuobj){
				$path =  trim($menuobj['path'],"/");
				if(PageAccessManager::GetPageAccess($path)=='AUTHORIZED'){
					?>
					<b-dropdown-item to="/<?php echo($path); ?>">
						<?php echo (!empty($menuobj['icon']) ? $menuobj['icon'] : null); ?> 
						<?php echo $menuobj['label']; ?>
						<?php
							if(!empty($menuobj['submenu'])){
								render_menu($menuobj['submenu']); 
							}
						?>
					</b-dropdown-item>
					<?php
				}
			}
		}
	}
?>