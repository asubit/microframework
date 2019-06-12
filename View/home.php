<h1>Asubit Microframework</h1>

<div class="content">
    <h2>Welcome!</h2>
	<p>You can switch between <code>dev</code> and <code>prod</code> environnement in <code>index.php</code>.</p>
	<p>The debug bar is only displayed in <code>dev</code> environment.</p>
	<p>See the <a href="https://github.com/asubit/microframework/blob/master/README.md">documentation</a> for create your first page.</p>
	<p>Fork this project on <a href="https://github.com/asubit/microframework">Github</a>.</p>
	<p>Go to <a href="/hello">hello</a> page.</p>

	<p><?php echo $this->variables['date']->format('Y-m-d H:i'); ?></p>

	<h2>Some pages</h2>

	<ul>
		<?php foreach ($this->variables['pages'] as $id): ?>
		<li>
			<a href="/page?id=<?php echo $id ?>">Page <?php echo $id ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>

