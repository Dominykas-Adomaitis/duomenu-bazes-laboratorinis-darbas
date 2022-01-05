<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Sutartys</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=report'>Sutarčių ataskaita</a>
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja sutartis</a>
</div>
<div class="float-clear"></div>

<table class="listTable">
	<tr>
		<th>Nr.</th>
		<th>Kaina</th>
		<th>Miestas</th>
		<th>Pirkėjas</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['nr']}</td>"
					. "<td>{$val['kaina']}</td>"
					. "<td>{$val['miestas']}</td>"
					. "<td>{$val['pirkejas']}</td>"
                                        . "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['nr']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['nr']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';
?>