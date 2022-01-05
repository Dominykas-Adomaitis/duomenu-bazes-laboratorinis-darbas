<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Užsakymas</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas užsakymas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Klientas nebuvo pašalintas, nes turi užsakymą (-ų).
	</div>
<?php } ?>

<table class="listTable">
	<tr>
		<th>Užsakymo nr.</th>
		<th>Adresas</th>
		<th></th>
                <th></th>
                <th>Užsakymo data</th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['uzsakymo_nr']}</td>"
					. "<td>{$val['pristatymo_miestas']}</td>"
					. "<td>{$val['pristatymo_gatve']}</td>"
                                        . "<td>{$val['pristatymo_namo_nr']}</td>"
                                        . "<td>{$val['uzsakymo_data']}</td>"
                                        . "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['uzsakymo_nr']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['uzsakymo_nr']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';
?>