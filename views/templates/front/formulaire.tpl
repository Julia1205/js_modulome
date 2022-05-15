{extends file='page.tpl'}
    {block name="page_title"}
        <h1>Devis avant-projet</h1>
    {/block}

    {block name="page_content"}
	    <img src="https://cdn.futura-sciences.com/buildsv6/images/mediumoriginal/6/5/2/652a7adb1b_98148_01-intro-773.jpg" />
		<form action ="" method="post">

			{if isset($step)}
				{if $step eq 1}
					<input type="text" value="{$step}" class="step">
					<input type="text" value="{$nbbedrooms}"  class="nbbedrooms" name="nbBedrooms">
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
					Step : <input type="text" value="{$step}" class="step">
					nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms">
					{foreach from=$bedroomsSizes key=k item=bedroomSize}
						bedroom{$k}Size : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> 
					{/foreach}
					<h2>Quel type de pièce à vivre souhaitez-vous ?</h2>
					<div class="row">
						<div class="col-6">
							<img src="">
							<label for="livingroomType">Concept à aire ouverte</label>
							<input type="radio" name="livingroomType" class="radio" value="0" id="livingroomType">
						</div>
						<div class="col-6">
							<img src="">
							<label for="livingroomType">Cuisine séparée</label>
							<input type="radio" name="livingroomType" class="radio" value="1" id="livingroomType">
						</div>
					</div>
					<input type="submit" name="submitpart3" value="Suivant">
				{elseif $step eq 3}
					Step : <input type="text" value="{$step}" class="step">
					nbBedrooms : <input type="text" value="{$nbbedrooms}" name="nbBedrooms" class="nbbedrooms">
					{foreach from=$bedroomsSizes key=k item=bedroomSize}
						bedroom{$k}Size : <input type="text" name="bedroomSize-{$k}" value="{$bedroomSize}"> 
					{/foreach}
					livingroomType : <input type="text" value="{$livingroomType}">




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
