<div id="navbar" class="w3-blue-grey w3-text-light-grey w3-sepia-min" style="display: none">
	
	<div class="w3-xlarge  w3-bar-block w3-text-light-grey w3-blue-grey ">
	<h3 class=" w3-bar-item w3-xxlarge">{{admin_menu_header}}</h3>
		{{admin_menu_items}}
			
			
  			<h3 class=" w3-bar-item w3-xxlarge">Members</h3>
			{{member_menu_items}}
			  			
			<h3 class="w3-bar-item w3-xxlarge">Other</h3>
			
			{{other_menu_items}}
  		
		</div>
</div>
	<script>
	var jPM = $.jPanelMenu({
    menu: '#navbar',
    trigger: '.menu',
    closeOnContentClick: false
});
jPM.on();
jPM.open();

</script>