<?= $this->Form->create(); ?>
	<?= $this->Form->input('name',['placeholder' => 'Name']); ?>
	<?= $this->Form->input('emailid',['placeholder' => 'Email ID']); ?>
	<?= $this->Form->input('phoneno',['placeholder' => 'Mobile No']); ?>
	<?= $this->Form->input('password',['type' => 'password','placeholder' => 'Password']); ?>
	<?= $this->Form->input('role',['placeholder' => 'Role','readonly'=>true,'value'=>$role]); ?>
	<?= $this->Form->submit('Register', ['class' => 'login-btn alt']); ?>
<?= $this->Form->end(); ?>