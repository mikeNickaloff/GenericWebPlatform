<?php
	class PdfWriter {
		var $content;
		function __construct($htmlContent, $filename) {
			
				$this->content = $htmlContent;
				$this->output = $filename;
				?>
<script src="/javascript/jquery.js"></script>
<script src="/javascript/jspdf.js"></script>
<script src="/javascript/plugins/from_html.js"></script>
<script src="/javascript/plugins/addhtml.js"></script>
<script src="/javascript/plugins/split_text_to_size.js"></script>
<script src="/javascript/plugins/standard_fonts_metrics.js"></script>

				
					
					
					
					
					
				
					
				
				<?php
		}
		
		function download() {
			?>
				<script>
					
					var newDiv = document.createElement("div");
					newDiv.innerHTML = "<?php print_r($this->content);?>"; 
					document.body.appendChild(newDiv);
				   var doc = new jsPDF();          
var elementHandler = {
  '#ignorePDF': function (element, renderer) {
    return true;
  }
};
var source = window.document.getElementsByTagName("div")[0];
doc.fromHTML(
    source,
    15,
    15,
    {
      'width': 180,'elementHandlers': elementHandler
    });

doc.output("dataurlnewwindow");
    
     					
					
					 
					 
					 
				</script>
			<?php
		}	
	}
?>