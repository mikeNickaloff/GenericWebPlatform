<div class="w3-panel w3-large w3-card w3-light-grey w3-hover-sand w3-bordered">
<form method="POST" action="/api/update_menu.php"> 
<input name="menu_id" type="hidden" value="{{menu_id}}" />
<div class="w3-col s10 m10 l4  w3-xlarge w3-bordered "> Menu Title </div><input name="menu_title" class=" w3-col s10 m10 l4 w3-input w3-margin-bottom" type="text" value="{{menu_title}}" />
</form>
<div class="w3-panel w3-section">
{{items}}

<form method="POST" action="/api/add_menu_item.php">
<input name="menu_id" type="hidden" value="{{menu_id}}" />
<input class="w3-button w3-input w3-half" type="submit" value="Add New Item" />
</form>
</div>

</div>