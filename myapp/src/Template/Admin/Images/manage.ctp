        <div class="image-gallery"><h1>Manage Gallery</h1>
        <div class="position-div">
                    <?php if(!($images->count()==0)): ?>
                    <div class="fotorama" data-width="100%" data-loop="true" data-autoplay="true" data-arrows="true" data-transition="crossfade" data-fit="cover" data-nav="thumbs">
                     <?php foreach ($images as $image): ?>
                        <img src="<?= $this->base.$image->photo_dir?>" data-caption="<?= 'Belongs to : '.$image->project->project_name ?>" id="<?= $image->id ?>">
                        <?php endforeach; ?>
                    </div>
                    <i class="fa fa-trash fa-3x delete-btn"></i>
                    <div>
                    <form id="del-form" method="post">
                        <input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $this->request->getParam('_csrfToken'); ?>">
                    </form>
                    <script>
                        $('.delete-btn').click(function(){
                        var $fotoramaDiv = $('.fotorama').fotorama();
                        var fotorama = $fotoramaDiv.data('fotorama');
                        $('#del-form').attr('action','/admin/images/delete/'+fotorama.activeFrame['id'])
                        $('#del-form').submit();});
                    </script>
                <?php else: ?>
                <div class="gallery-empty">
                    <center><i class="fa fa-exclamation circle fa-5x"></i><center>
                    <h1>There seems to be nothing here</h1>
                </div>
            <?php endif;?>
        </div></div></div>