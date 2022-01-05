<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Klientai</a></li>
	<li><?php if(!empty($id)) echo "Kliento redagavimas"; else echo "Naujas klientas"; ?></li>
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
			<legend>Kliento informacija</legend>
				<p>
					<label class="field" for="pirkejo_id">Kliento ID<?php echo in_array('pirkejo_id', $required) ? '<span> *</span>' : ''; ?></label>
					<?php if(!isset($data['editing'])) { ?>
						<input type="text" id="pirkejo_id" name="pirkejo_id" class="textbox textbox-150" value="<?php echo isset($data['pirkejo_id']) ? $data['pirkejo_id'] : ''; ?>" />
						<?php if(key_exists('pirkejo_id', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pirkejo_id']} simb.)</span>"; ?>
					<?php } else { ?>
						<span class="input-value"><?php echo $data['pirkejo_id']; ?></span>
						<input type="hidden" name="editing" value="1" />
						<input type="hidden" name="pirkejo_id" value="<?php echo $data['pirkejo_id']; ?>" />
					<?php } ?>
				</p>
			<p>
				<label class="field" for="vardas">Vardas<?php echo in_array('vardas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="vardas" name="vardas" class="textbox textbox-150" value="<?php echo isset($data['vardas']) ? $data['vardas'] : ''; ?>" />
				<?php if(key_exists('vardas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['vardas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="pavarde">Pavardė<?php echo in_array('pavarde', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pavarde" name="pavarde" class="textbox textbox-150" value="<?php echo isset($data['pavarde']) ? $data['pavarde'] : ''; ?>" />
				<?php if(key_exists('pavarde', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pavarde']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="miestas">Miestas<?php echo in_array('miestas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="miestas" name="miestas" class="textbox textbox-150" value="<?php echo isset($data['miestas']) ? $data['miestas'] : ''; ?>" />
				<?php if(key_exists('miestas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['miestas']} simb.)</span>"; ?>
			</p>
                        
                        <p>
				<label class="field" for="gatve">Gatvė<?php echo in_array('gatve', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="gatve" name="gatve" class="textbox textbox-150" value="<?php echo isset($data['gatve']) ? $data['gatve'] : ''; ?>" />
				<?php if(key_exists('gatve', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['gatve']} simb.)</span>"; ?>
			</p>
                        
                        <p>
				<label class="field" for="namo_nr">Namo nr.<?php echo in_array('namo_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="namo_nr" name="namo_nr" class="textbox textbox-150" value="<?php echo isset($data['namo_nr']) ? $data['namo_nr'] : ''; ?>" />
				<?php if(key_exists('namo_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['namo_nr']} simb.)</span>"; ?>
			</p>
                        
                        <p>
				<label class="field" for="pasto_kodas">Pašto kodas<?php echo in_array('namo_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pasto_kodas" name="pasto_kodas" class="textbox textbox-150" value="<?php echo isset($data['pasto_kodas']) ? $data['pasto_kodas'] : ''; ?>" />
				<?php if(key_exists('pasto_kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pasto_kodas']} simb.)</span>"; ?>
			</p>
                        
			<p>
				<label class="field" for="telefono_nr">Telefonas<?php echo in_array('telefono_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="telefono_nrs" name="telefono_nr" class="textbox textbox-150" value="<?php echo isset($data['telefono_nr']) ? $data['telefono_nr'] : ''; ?>" />
			</p>
			<p>
				<label class="field" for="el_pastas">Elektroninis paštas<?php echo in_array('el_pastas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="el_pastas" name="el_pastas" class="textbox textbox-150" value="<?php echo isset($data['el_pastas']) ? $data['el_pastas'] : ''; ?>" />
			</p>
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
	</form>
</div>