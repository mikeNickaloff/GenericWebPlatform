<div class="w3-grid w3-container w3-bottombar  ui segments w3-hover-khaki w3-panel  w3-margin-left">
<form method="POST" class="" action="/api/save_menu_item.php">
<input name="menu_id" value="{{menu_id}}" type="hidden" />
<input name="menu_item_id" value="{{menu_item_id}}" type="hidden" />
<div class="ui horizontal segment segments w3-col s10 m10 l4"><div class="w3-large w3-quarter w3-label"> Text: </div><input name="title" class="w3-input w3-quarter w3-center  w3-medium w3-animate-input" type="text" value="{{title}}" /></div>
<div class="ui horizontal segment segments w3-col s10 m10 l4"><div class=" w3-large w3-quarter w3-label"> URL: </div><input name="url" type="text" class="w3-input w3-quarter w3-center  w3-medium w3-animate-input" value="{{url}}" /> </div>
 <div class=" ui horizontal segment segments w3-col s10 m10 l4"><div class="w3-large w3-quarter w3-label">&nbsp; </div><input name="save"  class="w3-quarter w3-button w3-blue-grey w3-center w3-medium" type="submit" value="Save" /> </div>
</form>
</div>