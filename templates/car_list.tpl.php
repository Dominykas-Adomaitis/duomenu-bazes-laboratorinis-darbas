<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Baldai</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas baldas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Baldas nebuvo pašalintas, nes yra įtrauktas į sutartį (-is).
	</div>
<?php } ?>

<table class="listTable">
	<tr>
		<th>ID</th>
		<th>Kiekis</th>
		<th>Gamintojas ir modelis</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['id']}</td>"
					. "<td>{$val['kiekis']}</td>"
					. "<td>{$val['gamintojas']} {$val['modelis']}</td>"
					. "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['id']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';
?>