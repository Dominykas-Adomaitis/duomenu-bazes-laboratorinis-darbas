<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Užsakymai</a></li>
	<li><?php if(!empty($id)) echo "Užsakymo redagavimas"; else echo "Naujas užsakymas"; ?></li>
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
			<legend>Užsakymo informacija</legend>
                        
                        <p>
				<label class="field" for="fk_PIRKEJASpirkejo_id">Klientas<?php echo in_array('fk_PIRKEJASpirkejo_id', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_PIRKEJASpirkejoid" name="fk_PIRKEJASpirkejo_id">
					<option value="">---------------</option>
					<?php
						// išrenkame klientus
						$customers = $customersObj->getCustomersList();
						foreach($customers as $key => $val) {
							$selected = "";
							if(isset($data['fk_PIRKEJASpirkejo_id']) && $data['fk_PIRKEJASpirkejo_id'] == $val['pirkejo_id']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['pirkejo_id']}'>{$val['vardas']} {$val['pavarde']}</option>";
						}
					?>
				</select>
			</p>
                        
                        <p>
				<label class="field" for="fk_PIRKEJASpirkejo_id">Kliento el.paštas<?php echo in_array('fk_PIRKEJASpirkejo_id', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_PIRKEJASpirkejoid" name="fk_PIRKEJASpirkejo_id">
					<option value="">---------------</option>
					<?php
						// išrenkame klientus
						$customers = $customersObj->getCustomersList();
						foreach($customers as $key => $val) {
							$selected = "";
							if(isset($data['fk_PIRKEJASpirkejo_id']) && $data['fk_PIRKEJASpirkejo_id'] == $val['pirkejo_id']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['pirkejo_id']}'>{$val['el_pastas']} {$val['pavarde']}</option>";
						}
					?>
				</select>
			</p>
			<p>
				<label class="field" for="uzsakymo_nr">Užsakymo nr.<?php echo in_array('uzsakymo_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<?php if(!isset($data['editing'])) { ?>
					<input type="text" id="uzsakymo_nr" name="uzsakymo_nr" class="textbox textbox-150" value="<?php echo isset($data['uzsakymo_nr']) ? $data['uzsakymo_nr'] : ''; ?>" />
					<?php if(key_exists('uzsakymo_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['uzsakymo_nr']} simb.)</span>"; ?>
				<?php } else { ?>
					<span class="input-value"><?php echo $data['uzsakymo_nr']; ?></span>
					<input type="hidden" name="editing" value="1" />
					<input type="hidden" name="uzsakymo_nr" value="<?php echo $data['uzsakymo_nr']; ?>" />
				<?php } ?>
			</p>
			<p>
				<label class="field" for="pristatymo_miestas">Pristatymo miestas<?php echo in_array('pristatymo_miestas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pristatymo_miestas" name="pristatymo_miestas" class="textbox textbox-150" value="<?php echo isset($data['pristatymo_miestas']) ? $data['pristatymo_miestas'] : ''; ?>" />
				<?php if(key_exists('pristatymo_miestas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pristatymo_miestas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="pristatymo_gatve">Pristatymo gatvė<?php echo in_array('pristatymo_gatve', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pristatymo_gatve" name="pristatymo_gatve" class="textbox textbox-150" value="<?php echo isset($data['pristatymo_gatve']) ? $data['pristatymo_gatve'] : ''; ?>" />
				<?php if(key_exists('pristatymo_gatve', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pristatymo_gatve']} simb.)</span>"; ?>
			</p>
                        <p>
				<label class="field" for="pristatymo_namo_nr">Pristatymo namo nr.<?php echo in_array('pristatymo_namo_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pristatymo_namo_nr" name="pristatymo_namo_nr" class="textbox textbox-150" value="<?php echo isset($data['pristatymo_namo_nr']) ? $data['pristatymo_namo_nr'] : ''; ?>" />
				<?php if(key_exists('pristatymo_namo_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pristatymo_namo_nr']} simb.)</span>"; ?>
			</p>
                        <p>
				<label class="field" for="pristatymo_pasto_kodas">Pristatymo pašto kodas<?php echo in_array('pristatymo_pasto_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pristatymo_pasto_kodas" name="pristatymo_pasto_kodas" class="textbox textbox-150" value="<?php echo isset($data['pristatymo_pasto_kodas']) ? $data['pristatymo_pasto_kodas'] : ''; ?>" />
				<?php if(key_exists('pristatymo_pasto_kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pristatymo_pasto_kodas']} simb.)</span>"; ?>
			</p>
                        
                        <p>
				<label class="field" for="uzsakymo_data">Užsakymo data<?php echo in_array('uzsakymo_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="uzsakymo_data" name="uzsakymo_data" class="textbox textbox-70 date" value="<?php echo isset($data['uzsakymo_data']) ? $data['uzsakymo_data'] : ''; ?>">
                        </p>
                        
                       
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
	</form>
</div>