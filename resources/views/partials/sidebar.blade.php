<div id="sidebar_wrapper" class="wrapper">
	<h2 class="hatch"><span>Media Sosial</span></h2>
	<div class="social_wrapper">
		<ul class="social_buttons">
			<li class="social_item_wrapper">
				<a class="social_item fb" href="#" target="blank" title="Follow us on Facebook">
					<i class="fa fa-facebook social_icon"></i>
					<span class="social_name">Facebook</span>
				</a>
			</li>

			<li class="social_item_wrapper">
				<a class="social_item blog" href="#" target="blank" title="Follow our blog">
					<i class="fa fa-user-plus social_icon"></i>
					<span class="social_name">Blogger</span>
				</a>
			</li>

			<li class="social_item_wrapper">
				<a class="social_item twitter" href="#" target="blank" title="Follow us on Twitter">
					<i class="fa fa-twitter social_icon"></i>
					<span class="social_name">Twitter</span>
				</a>
			</li>

			<li class="social_item_wrapper">
				<a class="social_item g_plus" href="#" target="blank" title="Follow us on Google+">
					<i class="fa fa-google-plus social_icon"></i>
					<span class="social_name">Google+</span>
				</a>
			</li>
		</ul>
	</div>

	<h2 class="hatch"><span>Random articles</span></h2>
	<div class="thumb_wrapper">
		
		<ul class="blog_posts nav-list">

			@foreach($rands as $rand)
				<li class="small_post">
					<a href="#">
						<img class="pic" src="\img\{{ $rand->picture->directory }}" alt="Smooth Sweet Tea with Cookies">
					</a>
					<a class="thumb_title" href="#" title="Smooth Sweet Tea with Cookies">{{ $rand->title }}</a>
				</li>
			@endforeach

		</ul>
	</div>

	<h2 class="hatch"><span>Kategori</span></h2>
	<div class="dropdown dropdown2">
		<select class="dropdown-select dropdown-select2">
			<option> Pilih Kategori </option>
			<option class="labdrop" title="All Recipes" value="https://cokeskitti.blogspot.ro/search/label/All%20Recipes?&amp;max-results=7">
			All Recipes
			10
			</option>
			<option class="labdrop" title="Dessert" value="https://cokeskitti.blogspot.ro/search/label/Dessert?&amp;max-results=7">
			Dessert
			1
			</option>
			<option class="labdrop" title="Drinks" value="https://cokeskitti.blogspot.ro/search/label/Drinks?&amp;max-results=7">
			Drinks
			4
			</option>
			<option class="labdrop" title="Pizza" value="https://cokeskitti.blogspot.ro/search/label/Pizza?&amp;max-results=7">
			Pizza
			1
			</option>
		</select>
	</div>

	<h2 class="hatch"><span>Top 5</span></h2>
	<div class="thumb_wrapper">
		
		<ul class="blog_posts nav-list">
			
			@foreach($views as $view)
				<li class="small_post">
					<a href="#">
						<img class="pic" src="\img\{{ $view->picture->directory }}" alt="Smooth Sweet Tea with Cookies">
					</a>
					<a class="thumb_title" href="#" title="Smooth Sweet Tea with Cookies">{{ $view->title }}</a>
				</li>
			@endforeach
		
		</ul>
	</div>
</div>