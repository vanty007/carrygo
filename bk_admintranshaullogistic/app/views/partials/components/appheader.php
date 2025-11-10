<?php 
	
	$navbartopleft=array(
		
		array(
			'path' => 'review', 
			'label' => 'Review', 
			'icon' => ''
		)
	);

		
	
?>
<template id="AppHeader">
<header class="navigation fixed-top">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-white">
      <a class="navbar-brand order-1" href="index.html">
        <img class="img-fluid" width="100px" src="lib/images/logo.png"
          alt="Reader | Hugo Personal Blog Template">
      </a>
      <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
        <ul class="navbar-nav mx-auto">
		<?php
		if(user_login_status() == true){
		?>
		  <li class="nav-item">
            	<a class="nav-link" href="">Home</a>
          </li>
		  <li class="nav-item">
            	<a class="nav-link" href="#trackitems">Track Delivery Items</a>
          </li>
		  <!--<li class="nav-item">
            	<a class="nav-link" href="">Items in Transit</a>
          </li>-->	
		  <li class="nav-item">
            	<a class="nav-link" href="#payments">Payments History</a>
          </li>	  
		  <li class="nav-item">
            	<a class="nav-link" href="#user">User Information</a>
          </li>
		  <li class="nav-item">
            	<a class="nav-link" href="#riders_availability">Riders Information</a>
          </li>
		  <li class="nav-item">
            	<a class="nav-link" href="#delivery_option">Delivery Options</a>
          </li>
		  <!--<li class="nav-item">
            	<a class="nav-link" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="fa fa-sign-out"></i> Logout</a>
          </li>-->
		 <?php }?>
      </div>
	  <?php
		if(user_login_status() == true){
		?>
      <div class="order-2 order-lg-3 d-flex align-items-center">
        
        <!-- search 
        <form class="search-bar">
          <input id="search-query" name="s" type="text" placeholder="Enter Tracking ID">
        </form>-->
        
        <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse" data-target="#navigation">
          <i class="ti-menu"></i>
        </button>

			<div class="nav-item">
            	<a class="nav-link" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="fa fa-sign-out"></i> Logout</a>
          </div>
		  
      </div>


    </nav>
  </div>
  <?php }?>
</header>
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