{extends file='page.tpl'}
    {block name="page_title"}
        <h1>Devis avant-projet</h1>
    {/block}

    {block name="page_content"}
	    <img src="https://cdn.futura-sciences.com/buildsv6/images/mediumoriginal/6/5/2/652a7adb1b_98148_01-intro-773.jpg" />
		<form action ="" method="post">

			{if isset($step)}

				{if $step eq 1}
					<input type="text" value="{$step}" class="step"><br>
					<input type="text" value="{$nbbedrooms}"  class="nbbedrooms" name="nbBedrooms"><br>
					<h2>Quelle surface de chambre souhaitez-vous?</h2>
					{for $foo=1 to $nbbedrooms}
						<label for="bedroomSize-{$foo}"> Surface chambre {$foo} : </label>
							<select name="bedroomSize-{$foo}" id="bedroomSizes">
								<option value="10">10 m <sup>2</sup> </option>
								<option value="12">12 m <sup>2</sup> </option>
								<option value="15">15 m <sup>2</sup> </option>
								<option value="18">18 m <sup>2</sup> </option>
							</select>
							<br>
					{/for}
					<input type="submit" name="submitpart2" value="Suivant">

				{elseif $step eq 2}
					Step : <input type="text" value="{$step}" class="step"><br>
					nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
					{foreach from=$bedroomsSizes key=k item=bedroomSize}<br>
						bedroom{$k}Size : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
					{/foreach}
					<h2>Quel type de pièce à vivre souhaitez-vous ?</h2>
					<div class="row">
						<div class="col-6">
							<img src="">
							<label for="livingroomType">Concept à aire ouverte</label>
							<input type="radio" name="livingroomType" class="radio" value="open" id="livingroomType">
						</div>
						<div class="col-6">
							<img src="">
							<label for="livingroomType">Cuisine séparée</label>
							<input type="radio" name="livingroomType" class="radio" value="separated" id="livingroomType">
						</div>
					</div>
					<input type="submit" name="submitpart3" value="Suivant">

				{elseif $step eq 3}
					Step : <input type="text" value="{$step}" class="step"><br>
					nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
					{foreach from=$bedroomsSizes key=k item=bedroomSize}
						bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
					{/foreach}
					livingroomType : <input type="text" value="{$livingroomType}"><br>
					{if $livingroomType eq "open"}
					<h2>Quelle surface de pièce à vivre souhaitez-vous ?</h2>
					<br>
						Concept à aire ouverte
						<label for="LivingroomSize"> Surface totale de la pièce : </label>
						<select name="LivingroomSize" id="LivingroomSize">
							<option value="10">10 m <sup>2</sup> </option>
							<option value="12">12 m <sup>2</sup> </option>
							<option value="15">15 m <sup>2</sup> </option>
							<option value="18">18 m <sup>2</sup> </option>
						</select>

					{else}
						<br>
						
						<h2>Quelle surface de cuisine souhaitez-vous ?</h2>
						<label for="KitchenSize"> Surface de la cuisine : </label>
						<select name="KitchenSize" id="KitchenSize">
							<option value="10">10 m <sup>2</sup> </option>
							<option value="12">12 m <sup>2</sup> </option>
							<option value="15">15 m <sup>2</sup> </option>
							<option value="18">18 m <sup>2</sup> </option>
						</select>
						<h2>Quelle surface de séjour souhaitez-vous ?</h2>
						<label for="LivingroomSize"> Surface du séjour : </label>
						<select name="LivingroomSize" id="LivingroomSize">
							<option value="10">10 m <sup>2</sup> </option>
							<option value="12">12 m <sup>2</sup> </option>
							<option value="15">15 m <sup>2</sup> </option>
							<option value="18">18 m <sup>2</sup> </option>
						</select>
					{/if}
						<input type="submit" name="submitpart4" value="Suivant">

				{elseif $step eq 4}
						Step : <input type="text" value="{$step}" class="step"> <br>
						nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
						{foreach from=$bedroomsSizes key=k item=bedroomSize}
							bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
						{/foreach}
						livingroomType : <input type="text" value="{$livingroomType}"><br>
						{if $livingroomType eq false}
							LivingroomSize : <input type="text" value="{$LivingroomSize}"><br>
							KitchenSize : <input type="text" value="{$KitchenSize}"><br>
						{else}
							LivingroomSize : <input type="text" value="{$LivingroomSize}"><br>
						{/if}
						<h2>Souhaitez-vous une cuisine équipée ?</h2>
						<div>
							<input type="radio" name="equiped" class="radio" value="1" id="equiped">
							<label for="equiped">Oui</label>
						</div>
						<div>
							<input type="radio" name="equiped" class="radio" value="0" id="equiped">
							<label for="equiped">Non</label>
						</div>
						<input type="submit" name="submitpart5" value="Suivant">
					{elseif $step eq 5}





				{/if}

			{else}
			    <h2>Combien de chambres souhaitez-vous?</h2>
				<div>
					<input type="radio" name="nbBedrooms" class="radio" value="1" id="nbBedrooms" class="1bed">
					<label for="nbBedrooms">1</label>
				</div>
				<div>
					<input type="radio" name="nbBedrooms" class="radio" value="2" id="nbBedrooms">
					<label for="nbBedrooms">2</label>
				</div>
				<div>
					<input type="radio" name="nbBedrooms" class="radio" value="3" id="nbBedrooms">
					<label for="nbBedrooms">3</label>
				</div>
				<div >
					<input type="radio" name="nbBedrooms" class="radio" value="4" id="nbBedrooms">
					<label for="nbBedrooms">4</label>
				</div>
				<div >
					<input type="radio" name="nbBedrooms" class="radio" value="5" id="nbBedrooms">
					<label for="nbBedrooms">5</label>
				</div>
			<input type="submit" name="submitpart1" value="Suivant">
			{/if}

		</form>
	{/block}
