	<div id="right">
			<div class="right_articles">
			  <div>
			    <h2>Category</h2>
			  </div>
			  <div>
{section name=cat loop=$cat}

<a href="index.php?cat={$cat[cat].id}">{$cat[cat].name|capitalize:true}</a>&nbsp;&nbsp;
   
{/section}

</div>
			</div>
            
<div class="right_articles">
				<h2>Tags</h2>
				<div>
				  <div>
				    <div>{section name=tag loop=$tag}  <a href="index.php?tag={$tag[tag].name}" title="{$tag[tag].name}">{$tag[tag].name}</a>  {/section} </div>
			      </div>
	  </div>
			  <p>&nbsp;</p>
		  </div>
			<div class="right_articles">
				<p><img src="http://style.dailymotion.com/images/rss.gif" alt="Image" title="Image" class="image" /><span style="font-weight: bold">Featured Videos</span></p>
		        <p><img src="http://style.dailymotion.com/images/rss.gif" alt="Image" title="Image" class="image" /><span style="font-weight: bold">New Videos</span></p>
		        <p><img src="http://style.dailymotion.com/images/rss.gif" alt="Image" title="Image" class="image" /><span style="font-weight: bold">Tags</span></p>
		  </div>           
			<div class="notes">
				<p>Have any sugestions for this site <a href="http://templates.solucija.com/">Contact Us</a>.</p>
			</div>
		</div>

	<div id="footer">
			<p class="right">&copy; 2007 PHPDirector - Ben Swanson</p><!-- There is no obligtion to keep this notice here -->
			<p><a href="#">RSS Feed</a> &middot; <a href="#">Contact</a> &middot; <a href="#">Accessibility</a> &middot; <a href="#">Products</a> &middot; <a href="#">Disclaimer</a> &middot; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a><br /></p>
			
		</div>
	</div>
</body>
</html>