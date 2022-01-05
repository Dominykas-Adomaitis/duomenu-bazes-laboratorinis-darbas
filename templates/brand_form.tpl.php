<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Baldų gamintojai</a></li>
	<li><?php if(!empty($id)) echo "Gamintojo redagavimas"; else echo "Naujas gamintojas"; ?></li>
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
			<legend>Gamintojo informacija</legend>
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
            
                <fieldset>
			<legend>Papildomi modeliai</legend>
			<div class="childRowContainer">
				<div class="labelLeft<?php if(empty($data['papildomi_modeliai']) || sizeof($data['papildomi_modeliai']) == 0) echo ' hidden'; ?>">Modelio ID</div>
				<div class="labelRight<?php if(empty($data['papildomi_modeliai']) || sizeof($data['papildomi_modeliai']) == 0) echo ' hidden'; ?>">Pavadinimas</div>
                                <div class="labelRight<?php if(empty($data['papildomi_modeliai']) || sizeof($data['papildomi_modeliai']) == 0) echo ' hidden'; ?>">Gamintojo ID</div>
				<div class="float-clear"></div>
				<?php
					if(empty($data['papildomi_modeliai']) || sizeof($data['papildomi_modeliai']) == 0) {
				?>
					
					<div class="childRow hidden">
						<input type="text" name="idai[]" value="" class="textbox textbox-70" disabled="disabled" />
                                               <input type="text" name="pavadinimai[]" value="" class="textbox textbox-70" disabled="disabled" />
                                                <input type="text" name="gamintojai[]" value="" class="textbox textbox-70" disabled="disabled" />
						<a href="#" title="" class="removeChild">šalinti</a>
					</div>
					<div class="float-clear"></div>
					
				<?php
					} else {
						foreach($data['papildomi_modeliai'] as $key => $val) {
				?>
							<div class="childRow">
                                                            <input type="text" name="idai[]" value="<?php echo $val['id']; ?>" class="textbox textbox-70" />
                                                               <input type="text" name="pavadinimai[]" value="<?php echo $val['pavadinimas']; ?>" class="textbox textbox-70" />
                                                               <input type="text" name="gamintojai[]" value="<?php echo $val['fk_GAMINTOJASid']; ?>" class="textbox textbox-70" />
								
								<a href="#" title="" class="removeChild">šalinti</a>
							</div>
							<div class="float-clear"></div>
				<?php 
						}
					}
				?>
			</div>
			<p id="newItemButtonContainer">
				<a href="#" title="" class="addChild">Pridėti</a>
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