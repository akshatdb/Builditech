    <center>
    <i class="fa fa-user-circle fa-5x" aria-hidden="true"></i></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', $this->request->referer(), ['escape' => false, 'class' => 'close-btn']); ?>
    <h1>Edit Booking</h1>
    <?= $this->Form->create($booking) ?>
        <fieldset>
        <?php
            echo $this->Form->control('project_id',['required' => 'true','placeholder' => 'Project','option' => $projects]);
        ?>
        <div class="plot-grid"></div>
        <div id="clear-plots">Clear</div>

        <?php
            echo $this->Form->control('plotno',['required' => 'true','placeholder' => 'Plot No','type'=>'text','readonly' => true]);
            echo $this->Form->control('customer_name',['required' => 'true','placeholder' => 'Customer Name']);
            echo $this->Form->control('address',['required' => 'true','placeholder' => 'Address']);
            echo $this->Form->control('email',['required' => 'false','placeholder' => 'Email Address']);
            echo $this->Form->control('moba',['required' => 'true','placeholder' => 'Mobile No. 2']);
            echo $this->Form->control('mobb',['required' => 'false','placeholder' => 'Mobile No 1:']);
            echo $this->Form->control('booking_amt',['required' => 'true','placeholder' => 'Booking Amount']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'login-btn alt']) ?>
    <?= $this->Form->end() ?>
    <script>
        function createGrid(){
            $.ajax({
                    type: "POST",
                    header: {'X-CSRF-TOKEN' : this.csrfToken},
                    url: '/admin/projects/getGrid',
                    data: {
                        "id" : $('#project-id').val(),
                        "_csrfToken": '<?= $this->request->params['_csrfToken'] ?>'
                        },
                    success: function(data){
                        $('.plot-grid').html('');
                        var plots = data['bookedplots'];
                        alert
                        for (var i = 0; i < data['plots']; i++)
                            $('.plot-grid').append($('<div>',{
                                id: 'plot-'+(i+1),
                                class:'plot-ico free',
                                html: i+1
                            }))
                        if(plots != undefined)
                        plots.forEach(function(plot){
                            $('#plot-'+plot).removeClass('free').addClass('booked');
                        });
                        $('.plot-ico').on('click',function(){
                            if($('#plotno').val()!='')
                            $('#plotno').val($('#plotno').val()+','+$(this).html());
                            else
                            $('#plotno').val($(this).html());
                            $(this).addClass('selected-plot');
                        });
                        $('#clear-plots').show();
                    }
                        ,
                    dataType: 'json'
                });

        }
        $('#clear-plots').hide();
        $('#project-id').change(createGrid());
        $('#project-id').click(createGrid());
        $('#clear-plots').click(function(){
            $('#plotno').val('');
            $('.plot-grid').html('');
            $('#project-id').val('');
            $(this).hide();
        });
    </script>
