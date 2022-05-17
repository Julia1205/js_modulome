{extends file='page.tpl'}
    {block name="page_title"}
        <h1>Devis avant-projet</h1>
    {/block}

    {block name="page_content"}
	    <img src="https://cdn.futura-sciences.com/buildsv6/images/mediumoriginal/6/5/2/652a7adb1b_98148_01-intro-773.jpg" />
		<form action ="" method="post">

			{if isset($step)}

				step : <input type="text" value="{$step}" class="step"><br>
				{if $step eq 1}
					<input type="text" value="{$nbbedrooms}"  class="nbbedrooms" name="nbBedrooms"><br>
					<h2>Quelle surface de chambre souhaitez-vous?</h2>
					{for $foo=1 to $nbbedrooms}
						<label for="bedroomSize-{$foo}"> Surface chambre {$foo} : </label>
							<select name="bedroomSize-{$foo}" id="bedroomSizes">
								{foreach from=$sizes item=size key=key}
									<option value="{$size['modulome_size'] }">{$size['modulome_size']} m <sup>2</sup> </option>
								{/foreach}
							</select>
							<br>
					{/for}
					<input type="submit" name="submitpart2" value="Suivant">

				{elseif $step eq 2}
			
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
					nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
					{foreach from=$bedroomsSizes key=k item=bedroomSize}
						bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
					{/foreach}
					livingroomType : <input type="text" value="{$livingroomType}" name="livingroomType"><br>
					{if $livingroomType eq "open"}
					<h2>Quelle surface de pièce à vivre souhaitez-vous ?</h2>
					<br>
						Concept à aire ouverte
						<label for="livingroomSize"> Surface totale de la pièce : </label>
						<select name="livingroomSize" id="livingroomSize">
								{foreach from=$sizes item=size key=key}
									<option value="{$size['modulome_size'] }">{$size['modulome_size']} m <sup>2</sup> </option>
								{/foreach}
						</select>

					{else}
						<br>
						<h2>Quelle surface de cuisine souhaitez-vous ?</h2>
						<label for="kitchenSize"> Surface de la cuisine : </label>
						<select name="kitchenSize" id="kitchenSize">
								{foreach from=$kitchenSizes item=kitchenSize key=key}
									<option value="{$kitchenSize['modulome_size'] }">{$kitchenSize['modulome_size']} m <sup>2</sup> </option>
								{/foreach}
						</select>
						<h2>Quelle surface de séjour souhaitez-vous ?</h2>
						<label for="livingroomSize"> Surface du séjour : </label>
						<select name="livingroomSize" id="livingroomSize">
								{foreach from=$livingSizes item=livingSize key=key}
									<option value="{$livingSize['modulome_size'] }">{$livingSize['modulome_size']} m <sup>2</sup> </option>
								{/foreach}
						</select>
					{/if}
						<input type="submit" name="submitpart4" value="Suivant">

				{elseif $step eq 4}
						nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
						{foreach from=$bedroomsSizes key=k item=bedroomSize}
							bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
						{/foreach}
						livingroomType : <input type="text" value="{$livingroomType}" name="livingroomType"><br>
						{if $livingroomType eq "separated"}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
							kitchenSize : <input type="text" value="{$kitchenSize}" name="kitchenSize"><br>
						{else}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
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
						nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
						{foreach from=$bedroomsSizes key=k item=bedroomSize}
							bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
						{/foreach}
						livingroomType : <input type="text" value="{$livingroomType}" name="livingroomType"><br>
						{if $livingroomType eq "separated"}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
							kitchenSize : <input type="text" value="{$kitchenSize}" name="kitchenSize"><br>
						{else}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
						{/if}
						equiped : <input type="text" value="{$equiped}" name="equiped">
						<h2>Combien de salle de bain souhaitez-vous ?</h2>
						<label for="nbbathroom"> Nombre de salles de bain : </label>
						<select name="nbbathroom" id="nbbathroom">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
						<input type="submit" name="submitpart6" value="Suivant">

					{elseif $step eq 6}

						nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
						{foreach from=$bedroomsSizes key=k item=bedroomSize}
							bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
						{/foreach}
						livingroomType : <input type="text" value="{$livingroomType}" name="livingroomType"><br>
						{if $livingroomType eq "separated"}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
							kitchenSize : <input type="text" value="{$kitchenSize}" name="kitchenSize"><br>
						{else}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
						{/if}
						equiped : <input type="text" value="{$equiped}" name="equiped">
						nbbathroom : <input type="text" value="{$nbbathroom}" name="nbbathroom">
						<h2>Pour chaque salle de bain, indiquez si vous souhaitez des WC séparés</h2>
						{for $bar=1 to $nbbathroom}
							<h3>Salle de bain numéro {$bar}, souhaitez-vous des WC séparés?</h3>
							<div>
								<input type="radio" name="bathroom-{$bar}" class="radio" value="1" id="bathroom">
								<label for="bathroom-{$bar}">Oui</label>
							</div>
							<div>
								<input type="radio" name="nbbathroom-{$bar}" class="radio" value="0" id="bathroom">
								<label for="bathroom-{$bar}">Non</label>
							</div>
						{/for}
						<input type="submit" name="submitpart7" value="Suivant">
					{elseif $step eq 7}
						nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms"><br>
						{foreach from=$bedroomsSizes key=k item=bedroomSize}
							bedroomSize-{$k} : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> <br>
						{/foreach}
						livingroomType : <input type="text" value="{$livingroomType}" name="livingroomType"><br>
						{if $livingroomType eq "separated"}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
							kitchenSize : <input type="text" value="{$kitchenSize}" name="kitchenSize"><br>
						{else}
							livingroomSize : <input type="text" value="{$livingroomSize}" name="livingroomSize"><br>
						{/if}
						equiped : <input type="text" value="{$equiped}" name="equiped">
						nbbathroom : <input type="text" value="{$nbbathroom}" name="nbbathroom">
						{foreach from=$bathroomswithtoilet key=c item=bathroomwithtoilet}
						salle de bain {$c}<input type="text" value="{$bathroomwithtoilet}" name="bathroomwithtoilet-{$c}">
						{/foreach}
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