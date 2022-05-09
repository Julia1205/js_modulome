{extends file='page.tpl'}
    {block name="page_title"}

        <h1>Devis avant-projet</h1>
    {/block}
    {block name="page_content"}
    <img src="https://cdn.futura-sciences.com/buildsv6/images/mediumoriginal/6/5/2/652a7adb1b_98148_01-intro-773.jpg" />
    <h2>Combien de chambres souhaitez-vous?</h2>
		{block name="formulaire"}
			<!--formulaire chambres-->
					<form action ="" method="post">
						<div>
							<input type="radio" name="nbBedrooms" value="1" id="nbBedrooms" class="1bed">
							<label for="nbBedrooms">1</label>
						</div>
						<div >
							<input type="radio" name="nbBedrooms" value="2" id="nbBedrooms">
							<label for="nbBedrooms">2</label>
						</div>
						<div >
							<input type="radio" name="nbBedrooms" value="3" id="nbBedrooms">
							<label for="nbBedrooms">3</label>
						</div>
						<div >
							<input type="radio" name="nbBedrooms" value="4" id="nbBedrooms">
							<label for="nbBedrooms">4</label>
						</div>
						<div >
							<input type="radio" name="nbBedrooms" value="5" id="nbBedrooms">
							<label for="nbBedrooms">5</label>
						</div>
		{if isset($nbbedrooms)}
			<h2>Quelle surface de chambre souhaitez-vous?</h2>

			{for $foo=1 to $nbbedrooms}


			<label for="bedroomSize"> Surface chambre {$foo} : </label>
				<select name="bedroomSize">
					<option value="10">10 m <sup>2</sup> </option>
					<option value="12">12 m <sup>2</sup> </option>
					<option value="15">15 m <sup>2</sup> </option>
					<option value="18">18 m <sup>2</sup> </option>
				</select>

			{/for}
		{/if}
			<input type="submit" name="submitpart1" value="Suivant">

					</form>
		{/block}
	{/block}