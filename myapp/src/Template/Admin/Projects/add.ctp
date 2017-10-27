    <center>
    <i class="fa fa-globe fa-5x" aria-hidden="true"></i></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', $this->request->referer(), ['escape' => false, 'class' => 'close-btn']); ?>
    <h1>Add Project</h1>
    <?= $this->Form->create($project) ?>
    <fieldset>
        <?php
            echo $this->Form->control('project_name',['required' => 'true','placeholder' => 'Project Name']);
            echo $this->Form->control('description',['type' => 'textarea','required' => 'true','placeholder' => 'Description']);
            echo $this->Form->control('project_addr',['required' => 'true','placeholder' => 'Address']);
        ?>
        <div id="map"></div>
        <script>
        var map;
        var marker;
        function initMap() {
            var lucknow = {lat: 26.804467, lng: 80.899061};
            map = new google.maps.Map(document.getElementById('map'), {
            center: lucknow,
            zoom: 13
            });
            marker = new google.maps.Marker({
            position: lucknow,
            map: map
            });
            marker.setDraggable(true);
            google.maps.event.addListener(marker, 'dragend', function(event) {
            changePos();
            });
        }
        function changePos() {
            var latlng = marker.getPosition();
            $('#maplat').val(latlng.lat());
            $('#maplng').val(latlng.lng());
        }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZrfE0D-c83A8vkEriUkHCVrTRqOI_-hw&callback=initMap">
        </script>
        <?php
            echo $this->Form->control('maplat',['required' => 'true','placeholder' => 'Map Latitude']);
            echo $this->Form->control('maplng',['required' => 'true','placeholder' => 'Map Longitude']);
            echo $this->Form->control('noplots',['required' => 'true','placeholder' => 'Number of Plots']);
            echo $this->Form->control('amount',['required' => 'true','placeholder' => 'Amount Per Plot']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Next: Upload Images'),['class' => 'login-btn alt']) ?>
    <?= $this->Form->end() ?>
</div>

