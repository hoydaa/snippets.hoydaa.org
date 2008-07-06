<?php use_helper('Javascript') ?>

<script language="javascript">
	function checkForm() {
		if($('isTag').checked == true) {
			query = $('query').value;
			arr = query.split(" ");
			query = "";
			for(i=0;i<arr.length;i++)
				query += " and " + "tags:" + arr[i];
		    query = query.substring(5);
			$('query').value = query;
		}
	}
</script>
<?php echo form_tag('sfLucene/search', 'method=get class=search-controls') ?>

</form>