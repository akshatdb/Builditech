    <center>
    <i class="fa fa-picture-o fa-5x" aria-hidden="true"></i>
    <h1>Upload Image</h1></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', $this->request->referer(), ['escape' => false, 'class' => 'close-btn']); ?>
    <?= $this->Form->create($image,['enctype' => 'multipart/form-data','id' => 'uploadForm']) ?>
    <fieldset>
        <?php
            echo $this->Form->input('project_id',['readonly' => true, 'type' => 'text','value' => $project_id,'label'=>'Project Name']);
            echo $this->Form->input('photo', ['type' => 'file']);
        ?>
    </fieldset>
    <div class="img-btns">
    <?= $this->Form->button('Upload+',['class' => 'login-btn alt']) ?>
    <a href="/../admin/adminpanel" class="button alt link-btn">Stop</a></div>
    <?= $this->Form->end() ?>