		<footer>
			<div id="gauchefooter"></div>
			<div id="droitefooter"></div>
			<div id="titrecentre">
				<h1>Partenaires</h1>
			</div>
			<div id="centrefooter">
				<div class="partenaire">
					<a href="http://www.cartonnerie.fr/NEWSITE/index.php" target="_blanc">
						<img src="images/partenaires/cartonnerie.png" alt="la cartonnerie">
					</a>
				</div>
				<div class="partenaire">
					<a href="http://www.mindtherock.fr/" target="_blanc">
						<img src="images/partenaires/mindtherock.png" alt="Mind The Rock">
					</a>
				</div>
				<div class="partenaire">
					<a href="http://www.polca.fr/">
						<img src="images/partenaires/polca.png" alt="Polca" target="_blanc">
					</a>
				</div>
				<div class="clear"></div>
				<div class="partenaire partenaire-large">
					<a href="http://rjrradio.fr/">
						<img src="images/partenaires/rjr.png" alt="Radio Jeune Reims" target="_blanc">
					</a>
				</div>
				<div class="partenaire partenaire-large">
					<a href="http://www.radioprimitive.fr/www/Bienvenue.html" target="_blanc">
						<img src="images/partenaires/radioprimitive.png" alt="Radio Primitive">
					</a>
				</div>
			</div>
			<div id="copyright">
				<p>© Toutes les photographies sont la propriété du collectif ArtÉos. Merci de nous contacter pour toute utilisation.<br/>© Site Web réalisé par Damien Bécret, Lolita Grasset et <a href='http://axelbaron.fr/'>Axel Baron</a>.</p>
			</div>

		</footer>



	    <!-- use jssor.slider.mini.js (40KB) instead for release -->
	    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
	    <script type="text/javascript" src="js/jssor.js"></script>
	    <script type="text/javascript" src="js/jssor.slider.js"></script>

		<script src="js/jquery.masonry.min.js"></script>
		<script src="js/jquery.history.js"></script>
		<script src="js/js-url.min.js"></script>
		<script src="js/jquerypp.custom.js"></script>
		<script src="js/gamma.js"></script>
		<script type="text/javascript">

			$(function() {

				var GammaSettings = {
						// order is important!
						viewport : [ {
							width : 1920,
							columns : 6
						},

						{
							width : 1730,
							columns : 5
						},
						{
							width : 1200,
							columns : 4
						}, {
							width : 900,
							columns : 3
						}, {
							width : 500,
							columns : 2
						}, {
							width : 436,
							columns : 2
						}, {
							width : 320,
							columns : 1
						},{
							width : 0,
							columns : 1
						} ]
				};

				Gamma.init( GammaSettings, fncallback );


				// Example how to add more items (just a dummy):

				// ICI ON VOIT LES IMAGES QUI VONT ÊTRE CHARGÉES UNE FOIS QU'ON VA CLIQUER SUR LE BOUTON "LOADER MORE"

				var page = 0,
					items = ['<li><div data-alt="img03"   data-max-width="1800" data-max-height="1350"><div data-src="images/xxxlarge/3.jpg" data-min-width="1300"></div><div data-src="images/xxlarge/3.jpg" data-min-width="1000"></div><div data-src="images/xlarge/3.jpg" data-min-width="700"></div><div data-src="images/large/3.jpg" data-min-width="300"></div><div data-src="images/medium/3.jpg" data-min-width="200"></div><div data-src="images/small/3.jpg" data-min-width="140"></div><div data-src="images/xsmall/3.jpg"></div><noscript><img src="images/xsmall/3.jpg" alt="img03"/></noscript></div></li><li><div data-alt="img03"   data-max-width="1800" data-max-height="1350"><div data-src="images/xxxlarge/3.jpg" data-min-width="1300"></div><div data-src="images/xxlarge/3.jpg" data-min-width="1000"></div><div data-src="images/xlarge/3.jpg" data-min-width="700"></div><div data-src="images/large/3.jpg" data-min-width="300"></div><div data-src="images/medium/3.jpg" data-min-width="200"></div><div data-src="images/small/3.jpg" data-min-width="140"></div><div data-src="images/xsmall/3.jpg"></div><noscript><img src="images/xsmall/3.jpg" alt="img03"/></noscript></div></li><li><div data-alt="img03"   data-max-width="1800" data-max-height="1350"><div data-src="images/xxxlarge/3.jpg" data-min-width="1300"></div><div data-src="images/xxlarge/3.jpg" data-min-width="1000"></div><div data-src="images/xlarge/3.jpg" data-min-width="700"></div><div data-src="images/large/3.jpg" data-min-width="300"></div><div data-src="images/medium/3.jpg" data-min-width="200"></div><div data-src="images/small/3.jpg" data-min-width="140"></div><div data-src="images/xsmall/3.jpg"></div><noscript><img src="images/xsmall/3.jpg" alt="img03"/></noscript></div></li><li><div data-alt="img03"   data-max-width="1800" data-max-height="1350"><div data-src="images/xxxlarge/3.jpg" data-min-width="1300"></div><div data-src="images/xxlarge/3.jpg" data-min-width="1000"></div><div data-src="images/xlarge/3.jpg" data-min-width="700"></div><div data-src="images/large/3.jpg" data-min-width="300"></div><div data-src="images/medium/3.jpg" data-min-width="200"></div><div data-src="images/small/3.jpg" data-min-width="140"></div><div data-src="images/xsmall/3.jpg"></div><noscript><img src="images/xsmall/3.jpg" alt="img03"/></noscript></div></li><li><div data-alt="img03"   data-max-width="1800" data-max-height="1350"><div data-src="images/xxxlarge/3.jpg" data-min-width="1300"></div><div data-src="images/xxlarge/3.jpg" data-min-width="1000"></div><div data-src="images/xlarge/3.jpg" data-min-width="700"></div><div data-src="images/large/3.jpg" data-min-width="300"></div><div data-src="images/medium/3.jpg" data-min-width="200"></div><div data-src="images/small/3.jpg" data-min-width="140"></div><div data-src="images/xsmall/3.jpg"></div><noscript><img src="images/xsmall/3.jpg" alt="img03"/></noscript></div></li>']

				// ET ICI, LA FONCTION POUR LOADMORE DU NOM DE FNCALL
				function fncallback() {

					$( '#loadmore' ).show().on( 'click', function() {

						++page;
						var newitems = items[page-1]
						if( page <= 1 ) {

							Gamma.add( $( newitems ) );

						}
						if( page === 1 ) {

							$( this ).remove();

						}

					} );

				}

			});

		</script>
	</body>
</html>
