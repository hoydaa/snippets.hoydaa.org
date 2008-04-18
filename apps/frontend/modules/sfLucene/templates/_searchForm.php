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

<?php echo form_tag('sfLucene/search', array('method' => 'get', 'onsubmit' => 'checkForm()')) ?>
	<input type="text" name="query" size="80" id="query"/>&nbsp;<input type="submit" value="Search" class="button"/>
	<br/>
	<input type="radio" value="full" name="search_type" checked/>&nbsp;Full Text&nbsp;&nbsp;
	<input type="radio" value="tag" name="search_type" id="isTag"/>&nbsp;Tags Only
</form>