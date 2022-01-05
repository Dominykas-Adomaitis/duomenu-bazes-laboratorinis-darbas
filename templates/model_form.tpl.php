<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Baldų modeliai</a></li>
	<li><?php if(!empty($id)) echo "Modelio redagavimas"; else echo "Naujas modelis"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
            <div class="errorBox">
			Neįvesti arba neteisingai įvesti šie laukai:
			<?php 
				echo $formErrors;
			?>
            </div>
	<?php } ?>
	<form action="" method="post">
		<fieldset>
			<legend>Modelio informacija</legend>
			<p>
				<label class="field" for="brand">Gamintojas<?php echo in_array('fk_GAMINTOJASid', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="brand" name="fk_GAMINTOJASid">
					<option value="-1">Pasirinkite gamintoją</option>
					<?php
						// išrenkame visas markes
						$brands = $brandsObj->getBrandList();
						foreach($brands as $key => $val) {
							$selected = "";
							if(isset($data['fk_GAMINTOJASid']) && $data['fk_GAMINTOJASid'] == $val['id']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['id']}'>{$val['pavadinimas']}</option>";
						}
					?>
				</select>
			</p>
			<p>
				<label class="field" for="name">Pavadinimas<?php echo in_array('pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="pavadinimas" class="textbox textbox-150" value="<?php echo isset($data['pavadinimas']) ? $data['pavadinimas'] : ''; ?>">
				<?php if(key_exists('pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pavadinimas']} simb.)</span>"; ?>
			</p>
                        
                         <p>
				<label class="field" for="id">ID<?php echo in_array('id', $required) ? '<span> *</span>' : ''; ?></label>
				<?php if(!isset($data['editing'])) { ?>
					<input type="text" id="id" name="id" class="textbox textbox-150" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>" />
					<?php if(key_exists('id', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['id']} simb.)</span>"; ?>
				<?php } else { ?>
					<span class="input-value"><?php echo $data['id']; ?></span>
					<input type="hidden" name="editing" value="1" />
					<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
				<?php } ?>
			</p>
                        
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['id'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
		<?php } ?>
	</form>
</div>