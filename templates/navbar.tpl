	<!-- <div id="navbar" class=" w3-xlarge flexChild w3-rest w3-text-light-grey w3-blue-grey w3-grayscale">
		<div class="w3-xlarge  w3-bar-block w3-text-light-grey w3-blue-grey ">
  			<h3 class=" w3-bar-item w3-xxlarge">Menu</h3>
  			<a href="" class="w3-round w3-bar  w3-btn w3-hover-white w3-hover-text-dark-grey w3-xlarge">View Member</a>
  			<a href="#" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">Link 2</a>
  			<a href="#" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">Link 3</a>
		</div>
	</div> -->
	
	<div id="navbar" class="w3-blue-grey w3-text-light-grey w3-sepia-min" style="display: none">
	
	<div class="w3-xlarge  w3-bar-block w3-text-light-grey w3-blue-grey ">
  			<h3 class=" w3-bar-item w3-xxlarge">Menu</h3>
  			<a href="" class="w3-round w3-bar  w3-btn w3-hover-white w3-hover-text-dark-grey w3-xlarge">View Member</a>
  			<a href="#" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">Link 2</a>
  			<a href="#" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">Link 3</a>
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