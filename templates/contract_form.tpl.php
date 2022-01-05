<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Sutartys</a></li>
	<li><?php if(!empty($id)) echo "Sutarties redagavimas"; else echo "Nauja sutartis"; ?></li>
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
			<legend>Sutarties informacija</legend>
			<p>
				<?php if(!isset($data['editing'])) { ?>
					<label class="field" for="nr">Sutarties numeris<?php echo in_array('nr', $required) ? '<span> *</span>' : ''; ?></label>
					<input type="text" id="nr" name="nr" class="textbox textbox-70" value="<?php echo isset($data['nr']) ? $data['nr'] : ''; ?>">
				<?php } else { ?>
						<label class="field" for="nr">Numeris</label>
						<span class="input-value"><?php echo $data['nr']; ?></span>
						<input type="hidden" name="editing" value="1" />
						<input type="hidden" name="nr" value="<?php echo $data['nr']; ?>" />
				<?php } ?>
			</p>
                        
                        
                        <p>
				<?php if(!isset($data['editing'])) { ?>
					<label class="field" for="fk_UZSAKYMASuzsakymo_nr">Užsakymo nr.<?php echo in_array('fk_UZSAKYMASuzsakymo_nr', $required) ? '<span> *</span>' : ''; ?></label>
					<input type="text" id="fk_UZSAKYMASuzsakymo_nr" name="fk_UZSAKYMASuzsakymo_nr" class="textbox textbox-70" value="<?php echo isset($data['fk_UZSAKYMASuzsakymo_nr']) ? $data['fk_UZSAKYMASuzsakymo_nr'] : ''; ?>">
				<?php } else { ?>
						<label class="field" for="fk_UZSAKYMASuzsakymo_nr">Užsakymo nr.</label>
						<span class="input-value"><?php echo $data['fk_UZSAKYMASuzsakymo_nr']; ?></span>
						<input type="hidden" name="editing" value="1" />
						<input type="hidden" name="fk_UZSAKYMASuzsakymo_nr" value="<?php echo $data['fk_UZSAKYMASuzsakymo_nr']; ?>" />
				<?php } ?>
			</p>
                        
			<p>
				<label class="field" for="sutarties_data">Sutarties data<?php echo in_array('sutarties_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="sutarties_data" name="sutarties_data" class="textbox date textbox-70" value="<?php echo isset($data['sutarties_data']) ? $data['sutarties_data'] : ''; ?>">
			</p>
			
                        <p>
				<label class="field" for="apmokejimo_budas">Apmokėjimo būdas<?php echo in_array('apmokejimo_budas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="apmokejimo_budas" name="apmokejimo_budas" class="textbox textbox-70" value="<?php echo isset($data['apmokejimo_budas']) ? $data['apmokejimo_budas'] : ''; ?>">
			</p>
                        
			<p>
				<label class="field" for="kaina">Kaina<?php echo in_array('kaina', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="kaina" name="kaina" class="textbox textbox-70" value="<?php echo isset($data['kaina']) ? $data['kaina'] : ''; ?>"> <span class="units">&euro;</span>
			</p>
			<p>
				<label class="field" for="pristatymo_budas">Pristatymo būdas<?php echo in_array('pristatymo_budas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="apmokejimo_budas" name="pristatymo_budas" class="textbox textbox-70" value="<?php echo isset($data['pristatymo_budas']) ? $data['pristatymo_budas'] : ''; ?>">
			</p>
		</fieldset>
		
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>

		<input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>" />
	</form>
</div>