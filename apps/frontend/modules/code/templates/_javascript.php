<?php use_helper('Javascript', 'I18N') ?>

<script type="text/javascript">
//<![CDATA[

function autoSelect(el) {
    if(el && (el.tagName == "TEXTAREA" || (el.tagName == "INPUT" && el.type == "text"))) {
        el.select();
        return;
	}
    
    if(el && window.getSelection) { // FF, Safari, Opera
        var sel = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(el);
        sel.removeAllRanges();
        sel.addRange(range);
    } else if(el) { // IE
        document.selection.empty();
        var range = document.body.createTextRange();
        range.moveToElementText(el);
        range.select();
    }
}

//]]>
</script>

<div class="related">
	<span class="title">
		<?php echo __('Javascript Code') ?>
	</span>
	<div style="padding: 10px 0px 10px 0px;" id="code-javascript">
		new Snippet().getColored(<?php echo $code->getId() ?>);
	</div>
	<a href="#javascript-code" onclick="autoSelect($('code-javascript'))"><?php echo __('Select All') ?></a>	
</div>