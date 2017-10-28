<h2 class="project-header"><?= $project->project_name ?></h2>
<?php if(count($project->images) == 0): ?>
  <div style="height:500px;background-color: grey"></div>
<?php else: ?>
  <div style="height:500px;background-attachment:fixed;background-image: url(<?= $this->Url->build($project->images[0]->photo_dir,true)?>)"></div>
<?php endif; ?>
<section class="wrapper style1" style="padding:10px;">
  <div class="container">
    <div id="content">
      <article>
        <section>
          <h3>Description</h3>
          <article class="project-description">
              <p><?= nl2br(h($project->description)) ?></p>
          </article>
        </section>
      <div class="row">
        <section class="6u 12u(narrower">
        <h3>Videos</h3>
        <?php if(count($project->videos) != 0): ?>
          <div class="fotorama" data-loop="true" data-autoplay="true" data-arrows="true" data-transition="crossfade">
          <?php foreach($project->videos as $video): ?>
            <a href = "<?= $video->video_link ?>">$video->video_name</a>
          <?php endforeach; ?>
        
        <?php else: ?>
        <div style="width:100%;margin:100px 0px;"><center><i class="fa fa-5x fa-exclamation"></i><br><b>No Video!</b><center></div>
        <?php endif ?>
        </section>
        <section class="6u 12u(narrower)">
          <h3>Gallery</h3>
        <?php if(count($project->images) != 0): ?>
            <div class="fotorama" data-width="100%" data-loop="true" data-arrows="true" data-transition="crossfade">
              <?php foreach($project->images as $image): ?>
                <img src="/<?= $image->photo_dir ?>">
              <?php endforeach; ?>
            </div>
        <?php else: ?>
        <div style="width:100%;margin:100px 0px;"><center><i class="fa fa-5x fa-exclamation"></i><br><b>No Image!</b><center></div>
        <?php endif; ?>
        </section>
      </div>
        <section>
          <h3>Plots</h3>
          <div class="plot-grid"></div>
          <footer>
            <br>
            <ul>
              <li><i class="fa fa-square" style="color:#f28c86"></i>&nbspBooked</li>
              <li><i class="fa fa-square" style="color:#dddddd"></i>&nbspFree</li>
            </ul>
          </footer>
        </section>
        <?php
                    $plotsTable = Cake\ORM\ TableRegistry::get('Plots');
                    $bookedplots = $plotsTable->find('list')->where(['Plots.project_id =' => $project->id])->toArray();
        ?>
        <script>
                function createGrid(){
                        $('.plot-grid').html('');
                        var plotno = <?= $project->noplots ?>;
                        var plots = <?= "[".implode(',',$bookedplots)."]" ?>;
                        for (var i = 0; i < plotno; i++)
                            $('.plot-grid').append($('<div>',{
                                id: 'plot-'+(i+1),
                                class:'plot-ico free view',
                                html: i+1
                            }))
                        if(plots != undefined)
                        plots.forEach(function(plot){
                            $('#plot-'+plot).removeClass('free').addClass('booked');
                        });
                    }
                $(document).ready(createGrid());
        </script>
      </div>
      <div class="row" style="background-color: rgba(255, 255, 255, 0.42);">
          <section class="6u 12u(narrower)">
            <h3>Leave a Comment</h3>
              <?= $this->Form->create('Comment',['prefix'=>false,'url' => '/comments/add','method'=>'POST']); ?>
              <div class="row 100%">
                <div class="12u 12u(mobilep)">
                  <?= $this->Form->control('username',array('placeholder' => 'Name', 'label' => false, 'required' => true));?>
                  <?= $this->Form->control('project_id',array('type'=>'hidden','label' => false,'value'=>$project->id));?>
                </div>
              </div>
              <div class="row 50%">
                <div class="12u">
                  <?= $this->Form->control('body',array('type' => 'textarea', 'placeholder' => 'Message', 'label' => false, 'required' => true));?>
                </div>
              </div>
              <div class="row 50%">
                <div class="12u">
                  <ul class="actions">
                    <li><?= $this->Form->control('Submit',array('type'=>'submit','class'=>'button alt')) ?></li>
                  </ul>
                </div>
              </div>
              <?= $this->Form->end() ?>
          </section>
          <section class="6u 12u(narrower)">
            <h3>Location</h3>
            <div id="map" class="side-map"></div>
            <script>
            var map;
            var marker;
            function initMap() {
              var pos = {lat: <?= $project->maplat ?>, lng: <?= $project->maplng ?>};
              map = new google.maps.Map(document.getElementById('map'), {
              center: pos,
              zoom: 13
              });
              marker = new google.maps.Marker({
              position: pos,
              map: map
               });}
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZrfE0D-c83A8vkEriUkHCVrTRqOI_-hw&callback=initMap"></script>
          </section>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <section class="12u 12u(narrower)">
            <div class="comments">
              <h2>All Comments</h2>
              <div class="comments_list"></div>
            </div>
          </section>
        </div>
    </section>
    <script>
    $(document).ready(getComments('/comments/index'));
    function getComments(query){
      $.ajax({
              type: "POST",
              header: {'X-CSRF-TOKEN' : this.csrfToken},
              url: query,
              data: {
                  "_csrfToken": '<?= $this->request->params['_csrfToken'] ?>',
                  "id": <?= $project->id ?>
                  },
              success: function(data){
              $('.comments_list').hide().html(data).fadeIn();
              setPaginator();
              }
                  ,
              dataType: 'html'
          });
    }
    function setPaginator(){
      $('.comment-paginate a').click(function(event){
        event.preventDefault();
        if($(this).attr('href')){
          $('.comments_list').html("<center><img src='images/loading.gif'  class='loading-gif'/></center>");
          getComments($(this).attr('href'));}});
      }
  </script>
