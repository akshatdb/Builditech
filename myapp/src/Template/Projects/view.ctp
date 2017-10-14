                <section class="wrapper style1">
                    <div class="container">
                        <div id="content">

                            <!-- Content -->

                                <article>
                                    <header>
                                        <h2><?= $project->project_name ?></h2>
                                    </header>

                                    <span class="image featured">
                                        <div class="fotorama" data-width="100%" data-loop="true" data-autoplay="true" data-arrows="true" data-transition="crossfade">
                                            <?php foreach($project->images as $image): ?>
                                                <img src="<?= $image->photo_dir ?>">
                                            <?php endforeach; ?>
                                        </div>                                        
                                    </span>

                <section>
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
                <article>
                    <p><?= nl2br(h($project->description)) ?></p>
                </article>

                </section>
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
                </section>             <?php
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
        </div>
    </section>