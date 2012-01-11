<div class="file_details">
	<h2>{$xt240_movie.title}</h2>
	{if $xt240_movie.description or $xt240_movie.image !=""}
		<p>
			{if $xt240_movie.image != ""}<img style="float: left;" src="/download.php?file_id={$xt240_movie.image}&file_version=orig&download=true&file_version={$xt240_movie.image_version}" alt="{$xt240_movie.title}" />{/if}
			{$xt240_movie.description}
			<br />
			<br />
			<a href="/download.php?file_id={$xt240_movie.id}&download=true" title="Download">{"download_file_now"|livetranslate}</a>
		</p>
	{/if}
</div>