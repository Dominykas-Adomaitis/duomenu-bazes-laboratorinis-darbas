<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Baldai</a></li>
	<li><?php if(!empty($id)) echo "Baldo redagavimas"; else echo "Naujas baldas"; ?></li>
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
			<legend>Baldo informacija</legend>
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
                        
			<p>
				<label class="field" for="modelis">Modelis<?php echo in_array('modelis', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="modelis" name="modelis">
					<option value="-1">---------------</option>
					<?php
						// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
						$brands = $brandsObj->getBrandList();
						foreach($brands as $key => $val) {
							echo "<optgroup label='{$val['pavadinimas']}'>";

							$models = $modelsObj->getModelListByBrand($val['id']);
							foreach($models as $key2 => $val2) {
								$selected = "";
								if(isset($data['modelis']) && $data['modelis'] == $val2['id']) {
									$selected = " selected='selected'";
								}
								echo "<option{$selected} value='{$val2['id']}'>{$val2['pavadinimas']}</option>";
							}
						}
					?>
				</select>
			</p>
			<p>
				<label class="field" for="kiekis">Kiekis<?php echo in_array('kiekis', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="kiekis" name="kiekis" class="textbox textbox-70" value="<?php echo isset($data['kiekis']) ? $data['kiekis'] : ''; ?>">
				<?php if(key_exists('kiekis', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['kiekis']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="pagaminimo_data">Pagaminimo data<?php echo in_array('pagaminimo_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pagaminimo_data" name="pagaminimo_data" class="textbox textbox-70 date" value="<?php echo isset($data['pagaminimo_data']) ? $data['pagaminimo_data'] : ''; ?>">
                        </p>
			<p>
				<label class="field" for="tipas">Tipas<?php echo in_array('tipas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="tipas" name="tipas" class="textbox textbox-70" value="<?php echo isset($data['tipas']) ? $data['tipas'] : ''; ?>">
				<?php if(key_exists('tipas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['tipas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="produktas">Produktas<?php echo in_array('produktas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="produktas" name="produktas" class="textbox textbox-70" value="<?php echo isset($data['produktas']) ? $data['produktas'] : ''; ?>">
				<?php if(key_exists('produktas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['produktas']} simb.)</span>"; ?>
			</p>


			<p>
				<label class="field" for="plotis">Plotis<?php echo in_array('plotis', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="plotis" name="plotis" class="textbox textbox-70" value="<?php echo isset($data['plotis']) ? $data['plotis'] : ''; ?>"><span class="units">cm.</span>
			</p>
                        
                        <p>
				<label class="field" for="ilgis">Ilgis<?php echo in_array('ilgis', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="ilgis" name="ilgis" class="textbox textbox-70" value="<?php echo isset($data['ilgis']) ? $data['ilgis'] : ''; ?>"><span class="units">cm.</span>
			</p>
                        
                        <p>
				<label class="field" for="aukstis">Aukštis<?php echo in_array('aukstis', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="aukstis" name="aukstis" class="textbox textbox-70" value="<?php echo isset($data['aukstis']) ? $data['aukstis'] : ''; ?>"><span class="units">cm.</span>
			</p>
                        
			<p>
				<label class="field" for="spalva">Spalva<?php echo in_array('spalva', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="spalva" name="spalva" class="textbox textbox-70" value="<?php echo isset($data['spalva']) ? $data['spalva'] : ''; ?>">
				<?php if(key_exists('spalva', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['spalva']} simb.)</span>"; ?>
			</p>
                        
                        <p>
				<label class="field" for="medziaga">Medžiaga<?php echo in_array('medziagas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="medziaga" name="medziaga" class="textbox textbox-70" value="<?php echo isset($data['medziaga']) ? $data['medziaga'] : ''; ?>">
				<?php if(key_exists('medziaga', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['medziaga']} simb.)</span>"; ?>
			</p>
			
			<p>
				<label class="field" for="svoris">Svoris<?php echo in_array('svoris', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="svoris" name="svoris" class="textbox textbox-70" value="<?php echo isset($data['svoris']) ? $data['svoris'] : ''; ?>"><span class="units">kg.</span>
			</p>
		
			<p>
				<label class="field" for="kaina">Kaina<?php echo in_array('kaina', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="kaina" name="kaina" class="textbox textbox-70" value="<?php echo isset($data['kaina']) ? $data['kaina'] : ''; ?>"><span class="units">&euro;</span>
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