<h1>Login</h1>
<?= $this->Form->create(); ?>
	<?= $this->Form->input('emailid',['placeholder' => 'Email ID']); ?>
	<?= $this->Form->input('password',['type' => 'password','placeholder' => 'Password']); ?>
	<?= $this->Form->submit('Login', ['class' => 'login-btn alt']); ?>
	<br>
<?= $this->Form->end(); ?>