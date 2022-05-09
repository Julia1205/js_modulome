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
			<!--fin chambres-->
			<!--début select surface chambre-->
	<h2>Quelle surface de chambre souhaitez-vous?</h2>

			<label for="bedroomSize"> Surface chambre 1 : </label>
				<select name="bedroomSize">
					<option value="10">10 m <sup>2</sup> </option>
					<option value="12">12 m <sup>2</sup> </option>
					<option value="15">15 m <sup>2</sup> </option>
					<option value="18">18 m <sup>2</sup> </option>
				</select>
			<label for="bedroomSize"> Surface chambre 2 : </label>
				<select name="bedroomSize">
					<option value="10">10 m <sup>2</sup> </option>
					<option value="12">12 m <sup>2</sup> </option>
					<option value="15">15 m <sup>2</sup> </option>
					<option value="18">18 m <sup>2</sup> </option>
				</select>
			<label for="bedroomSize"> Surface chambre 3 : </label>
				<select name="bedroomSize">
					<option value="10">10 m <sup>2</sup> </option>
					<option value="12">12 m <sup>2</sup> </option>
					<option value="15">15 m <sup>2</sup> </option>
					<option value="18">18 m <sup>2</sup> </option>
				</select>
			<label for="bedroomSize"> Surface chambre 4 : </label>
				<select name="bedroomSize">
					<option value="10">10 m <sup>2</sup> </option>
					<option value="12">12 m <sup>2</sup> </option>
					<option value="15">15 m <sup>2</sup> </option>
					<option value="18">18 m <sup>2</sup> </option>
				</select>
			<label for="bedroomSize"> Surface chambre 5 : </label>
				<select name="bedroomSize">
					<option value="10">10 m <sup>2</sup> </option>
					<option value="12">12 m <sup>2</sup> </option>
					<option value="15">15 m <sup>2</sup> </option>
					<option value="18">18 m <sup>2</sup> </option>
				</select>
			<h2>Combien souhaitez-vous de salles de bain?</h2>
			<h3>Pièce avec WC</h3>
				<input type="radio" name="nbFullBathrooms" value="0">
					<label for="nbFullBathrooms">0</label>
				<input type="radio" name="nbFullBathrooms" value="1">
					<label for="nbFullBathrooms">1</label>
				<input type="radio" name="nbFullBathrooms" value="2">
					<label for="nbFullBathrooms">2</label>
				<input type="radio" name="nbFullBathrooms" value="3">
					<label for="nbFullBathrooms">3</label>
			<h3>Pièce sans WC</h3>
				<input type="radio" name="nbBathrooms" value="0">
					<label for="nbBathrooms">0</label>
				<input type="radio" name="nbBathrooms" value="1">
					<label for="nbBathrooms">1</label>
				<input type="radio" name="nbBathrooms" value="2">
					<label for="nbBathrooms">2</label>
				<input type="radio" name="nbBathrooms" value="3">
					<label for="nbBathrooms">3</label>
			<h2>Pièce à vivre</h2>
			<img src="">
				<input type="radio" name="livingroom" value="openarea">
					<label for="livingroom">Concept à aire ouverte (cuisine et pièce à vivre)</label>
			<img src="">
				<input type="radio" name="livingroom" value="separate">
					<label for="livingroom">Cuisine et pièce à vivre séparées</label>
			<h3>Surface de pièce à vivre</h3>
			<label for="openAereaSize"> Surface de la pièce à vivre à aire ouverte : </label>
				<select name="openAreaSize">
					<option value="30">30 m <sup>2</sup> </option>
					<option value="40">40 m <sup>2</sup> </option>
					<option value="50">50 m <sup>2</sup> </option>
					<option value="60">60 m <sup>2</sup> </option>
				</select>
			<label for="separateAreaSize"> Surface du salon : </label>
				<select name="separateAreaSize">
					<option value="30">30 m <sup>2</sup> </option>
					<option value="40">40 m <sup>2</sup> </option>
					<option value="50">50 m <sup>2</sup> </option>
					<option value="60">60 m <sup>2</sup> </option>
				</select>
			<label for="kitchen"> Surface de la cuisine : </label>
				<select name="kitchen">
					<option value="30">30 m <sup>2</sup> </option>
					<option value="40">40 m <sup>2</sup> </option>
					<option value="50">50 m <sup>2</sup> </option>
					<option value="60">60 m <sup>2</sup> </option>
				</select>
			<h3>Souhaitez-vous une cuisine équipée ?</h3>
				<input type="radio" name="equiped" value="1">
					<label for="equiped">Oui</label>
				<input type="radio" name="equiped" value="0">
					<label for="equiped">Non</label>
			<input type="submit" name="submitpart1" value="Suivant">

					</form>
		{/block}
	{/block}