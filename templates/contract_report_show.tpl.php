<ul id="reportInfo">
	<li class="title">Sutarčių ataskaita</li>
	<li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
	<li>Sutarčių sudarymo laikotarpis:
		<span>
		<?php
			if(!empty($data['dataNuo'])) {
				if(!empty($data['dataIki'])) {
					echo "nuo {$data['dataNuo']} iki {$data['dataIki']}";
				} else {
					echo "nuo {$data['dataNuo']}";
				}
			} else {
				if(!empty($data['dataIki'])) {
					echo "iki {$data['dataIki']}";
				} else {
					echo "nenurodyta";
				}
			}
		?>
		</span>
	</li>
</ul>
<?php		
	if(sizeof($contractData) > 0) { ?>
		<table class="reportTable">
			<tr class="gray">
				<th>ID</th>
                                <th>Miestas</th>
				<th>Gatvė</th>
                                <th>Kaina</th>
                                <th>Sutarties_data</th>
			</tr>
			
			<?php
				// suformuojame lentelę
				foreach($contractData as $key => $val) {
					echo
						"<tr>"
                                                        . "<td>{$val['nr']}</td>"
							. "<td>{$val['pristatymo_miestas']}</td>"
                                                        . "<td>{$val['pristatymo_gatve']}</td>"
                                                        . "<td>{$val['kaina']}</td>"
                                                        . "<td>{$val['sutarties_data']}</td>"
                                                       
                                                       
                                                            
						. "</tr>";
				}
			?>
			
		  	<tr>
				<td class='groupSeparator' colspan='5'>Bendra suma</td>
			</tr>
                        
                        <tr class="aggregate">
				<td class="label" style="text-align: right" colspan="2"></td>
				<td class="border"><?php echo $totalPrice[0]['suma']; ?> &euro;</td>
				
				</td>
			</tr>
                        
                        <tr>
				<td class='groupSeparator' colspan='5'>Naujausia sutartis</td>
			</tr>
			
			<tr class="aggregate">
				<td class="label" style="text-align: right" colspan="2"></td>
				<td class="border"><?php echo "{$totalServicePrice[0]['laikas']}"; ?></td>
				
				</td>
			</tr>
		</table>
		<a href="index.php?module=contract&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotartpiu paslaugų užsakyta nebuvo.
		</div>
<?php
	}
?>