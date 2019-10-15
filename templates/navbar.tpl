<div id="navbar" class="w3-blue-grey w3-text-light-grey w3-sepia-min" style="display: none">
	
	<div class="w3-xlarge  w3-bar-block w3-text-light-grey w3-blue-grey ">
		{{admin_menu}}
			
			
  		{{member_menu}}
			  			
			
			{{other_menu}}
  		
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