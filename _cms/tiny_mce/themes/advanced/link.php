<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_insert_link_title}</title>
	<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/validate.js"></script>
	<script language="javascript" type="text/javascript" src="jscripts/link.js"></script>
	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');" style="display: none">
<form onsubmit="insertLink();return false;" action="#">
	<div class="tabs">
		<ul>
			<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;">{$lang_insert_link_title}</a></span></li>
		</ul>
	</div>

	<div class="panel_wrapper">
		<div id="general_panel" class="panel current">

		<table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><label for="href">{$lang_insert_link_url}</label></td>
            <td><table border="0" cellspacing="0" cellpadding="0"> 
				  <tr> 
					<td><input id="href" name="href" type="text" value="" style="width: 200px" onchange="checkPrefix(this);" /></td> 
					<td id="hrefbrowsercontainer">&nbsp;</td>
				  </tr> 
				</table></td>
          </tr>
		  <!-- Link list -->
		  <script language="javascript">
			if (typeof(tinyMCELinkList) != "undefined" && tinyMCELinkList.length > 0) {
				var html = "";

				html += '<tr><td><label for="link_list">{$lang_link_list}</label></td>';
				html += '<td><select id="link_list" name="link_list" style="width: 200px" onchange="this.form.href.value=this.options[this.selectedIndex].value;">';
				html += '<option value="">---</option>';

				for (var i=0; i<tinyMCELinkList.length; i++)
					html += '<option value="' + tinyMCELinkList[i][1] + '">' + tinyMCELinkList[i][0] + '</option>';

				html += '</select></td></tr>';

				document.write(html);
			}
		  </script>
		  <!-- /Link list -->
          <tr>
            <td nowrap="nowrap"><label for="target">{$lang_insert_link_target}</label></td>
            <td><select id="target" name="target" style="width: 200px">
                <option value="_self">{$lang_insert_link_target_same}</option>
                <option value="_blank">{$lang_insert_link_target_blank}</option>
				<script language="javascript">
					var html = "";
					var targets = tinyMCE.getParam('theme_advanced_link_targets', '').split(';');

					for (var i=0; i<targets.length; i++) {
						var key, value;

						if (targets[i] == "")
							continue;

						key = targets[i].split('=')[0];
						value = targets[i].split('=')[1];

						html += '<option value="' + value + '">' + key + '</option>';
					}

					document.write(html);
				</script>
            </select></td>
          </tr>
          <tr>
            <td nowrap="nowrap"><label for="linktitle">{$lang_theme_insert_link_titlefield}</label></td>
            <td><input id="linktitle" name="linktitle" type="text" value="" style="width: 200px"></td>
          </tr>
          <tr id="styleSelectRow">
            <td><label for="styleSelect">{$lang_class_name}</label></td>
            <td>
			 <select id="styleSelect" name="styleSelect">
                <option value="" selected>{$lang_theme_style_select}</option>
             </select></td>
          </tr>
        </table>
		</div>
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertLink();" />
		</div>

		<div style="float: right">
			<input type="button" id="cancel" name="cancel" value="{$lang_cancel}" onclick="tinyMCEPopup.close();" />
		</div>
	</div>
</form>
</body>
</html>
