<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Samuel Stephan Portfolio</title>
    
    <link rel="stylesheet" href="stylesheets/style.css">
  </head>

	<body>
		
		<header>
			<div id="console"></div>
		</header>
		<main>
			<div class="bg"></div>
			<div class="mainwrapper">
	    	  
		      <div class="wheel"></div>

			  <?php include 'parts/sample1.php'; ?>
			  <?php include 'parts/sample2.php'; ?>
			  <?php include 'parts/sample1.php'; ?>
			  <?php include 'parts/sample2.php'; ?>
			  
			  <?php include 'parts/sample2.php'; ?>
			  <?php include 'parts/sample1.php'; ?>
			  <?php include 'parts/sample2.php'; ?>
			  <?php include 'parts/sample1.php'; ?>
			  
			  <?php include 'parts/sample1.php'; ?>
			  <?php include 'parts/sample2.php'; ?>
			  <?php include 'parts/sample1.php'; ?>
			  <?php include 'parts/sample2.php'; ?>
				
			</div>
			<div class="contact">
					<br>
					<div class="contactlink backbtn"></div>
					<p><br>
						Hi, <br>
						Kale chips keytar beard, sartorial ea jean shorts dolore polaroid exercitation disrupt chicharrones keffiyeh tumblr kitsch. Gastropub squid adipisicing keytar. Craft beer tousled tofu, iceland letterpress ad single-origin coffee church-key salvia. Swag paleo single-origin coffee commodo, velit nisi try-hard air plant. Bicycle rights commodo ut ad vinyl, fugiat plaid locavore assumenda cardigan tumblr trust fund meggings waistcoat aliqua. Normcore dolor readymade marfa street art coloring book post-ironic raclette. Squid ad ennui banjo.
					</p>
					
			</div>
			<div class="cut"></div>
		</main>		
		
		<footer>				
			<a class="contactlink">contact &amp; info</a> <a href="">link</a>
		</footer>
		
		<!--font-->
		<script src="//use.edgefonts.net/actor.js" type="text/javascript"></script>
		<!--jQuery-->
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>
		</script>
		<!--onAnimationEnd, onTransitionEnd functions --> 
		<script src="javascripts/jquery.oncssanimationend.js" type="text/javascript"></script>
		<!-- get offset relative to viewport
		 http://benalman.com/projects/jquery-misc-plugins/#viewportoffset-->
		<script src="javascripts/jquery.ba-viewportoffset.min.js"></script>
	</body>
	
	<script>
		/************************************
		gallerymode 1: background-size cover
		gallerymode 2: Background-size contain
		
		galleryformat 1: portrait
		galleryformat 2: landscape
		************************************/
		
		// Gallery
		(function(){			
			//gallery 
			$('[data-galleryimage]').click( function() {
				var imagePath = this.getAttribute('data-galleryimage');
				var parentArticle = $(this).closest('article');				
				var galleryMode = this.closest('ul').getAttribute('data-gallerymode');
				var galleryAspectRatio = this.closest('ul').getAttribute('data-galleryformat');

				parentArticle.css({
							 'background-image': 'url('+imagePath+')',
							 'background-position': 'center center'
							  });
				//move to viewport center
				function vCenter (view) {
					var articleY = parentArticle.viewportOffset().top;
					var articleX = parentArticle.viewportOffset().left;
					var viewporX = $(window).width();
					var viewportY = $(window).height();
					if(view == 2) {
						var articleDestX = (viewporX-parentArticle.width()*2.4)*0.5;
						var articleDestY = (viewportY-parentArticle.height()*1.35)*0.5;
					}
					if(view == 1) {
						var articleDestX = (viewporX-parentArticle.width()*2)*0.5;
						var articleDestY = (viewportY-parentArticle.height()*1.65)*0.5;
					}					
					var diffX = (articleDestX - articleX);
					var diffY = (articleDestY - articleY);
					var translate = 'translateX('+diffX+'px) translateY('+diffY+'px)';
					parentArticle.css('transform', translate);
				}
				
				if ( galleryMode == '2') {
					parentArticle.addClass('gallerymode2');
				}
				if ( parentArticle.hasClass('galleryview') == false ) {
					if (galleryAspectRatio == '1') {
						parentArticle.addClass('galleryview view1');
						setTimeout(vCenter(1),320);
					}
					if (galleryAspectRatio == '2') {
						parentArticle.addClass('galleryview view2');
						setTimeout(vCenter(2),320);
					}
				}
				
			});
			//close gallery but leave article open
			$('.closegallery').click(function(){
				var parentArticle = $(this).closest('article');
				parentArticle.removeAttr('style').removeClass('galleryview gallerymode2 view1 view2');
				document.getElementById('video_corrupt').pause(); //provisorisch
			});
			
			$('.togglemode').click(function(){
				var parentArticle = $(this).closest('article');
				$(this).toggleClass('max');
				parentArticle.css({'background-color': '#454545'}).toggleClass('gallerymode2');
			});
		} ());

		//general button 
		(function()  {
			function scrollViewport(e) {			
				var parentArticle = e.closest('article');
				console.log(parentArticle, parentArticle.offset().top, parentArticle.height());

				console.log(window.innerHeight, $(window).scrollTop())

				if (parentArticle.offset().top + parentArticle.height() > window.innerHeight + $(window).scrollTop()){
//					var a = $(this)
					console.log('bigger');
					$('html,body').animate({scrollTop: parentArticle.offset().top})
				}
				
//				return false;
			};
			
			setTimeout(function(){ //prevent user to click while loading
				// open article
				$('.button-open').click(function () { 
					var button = $(this);
					$('.expand').removeClass('expand galleryview gallerymode2 view1 view2').removeAttr('style');
					$(this).parent().addClass('expand');
					setTimeout(function(){
						console.log('now');
						scrollViewport(button);
					}, 500); //onCSSTransitionEnd() only gets the starting height *sadface*
					
				});

				// close article when clicking outside it
				$(document).click(function(event){
					var clickTarget = $(event.target);
					if ( clickTarget.parents('article.expand').length == 0 && !clickTarget.is('article') || clickTarget.hasClass('button-close') ){
						$('.expand').removeAttr('style').removeClass('expand galleryview gallerymode2 view1 view2');
					} 
				});
				
				$('.contactlink').click(function() {
					$('.mainwrapper').toggle();
					$('.contact').toggle();	
				});		
				
				//start video
				$('#startvideo_corrupt').click(function(){
					document.getElementById('video_corrupt').play();
				});
			},2000);
			
		} ());
		
		// Page Loading
		(function () { 
			var pageLoaded = false;
			var minTimeElapsed = false;
			setTimeout(function(){
				$('.wheel').addClass('loading');
			}, 700);


			function engage() {
				if(minTimeElapsed && pageLoaded) {
					$('.wheel').removeClass('loading').onCSSTransitionEnd( function() {
						$('article').removeClass('hidden');
						$('.wheel').hide();
					});
				}
			}

			setTimeout(function(){ 
				minTimeElapsed = true;
				engage();
			}, 1500);

			$(window).load(function(){
				pageLoaded = true;
				engage();
			});
		} ());
		

	</script>
	

</html>
