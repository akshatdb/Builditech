    <center>
    <i class="fa fa-user-circle fa-5x" aria-hidden="true"></i></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', $this->request->referer(), ['escape' => false, 'class' => 'close-btn']); ?>
    <h1>Booking Client</h1>
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
            echo $this->Form->control('email',['required' => 'true','placeholder' => 'Email ID']);
            echo $this->Form->control('moba',['required' => 'true','placeholder' => 'Mobile No. 2']);
            echo $this->Form->control('mobb',['required' => 'true','placeholder' => 'Mobile No 1:']);
            echo $this->Form->control('booking_amt',['required' => 'true','placeholder' => 'Booking Amount']);
            echo '<div class="input payselect"><b>Payment Mode :</b></div>';
            echo $this->Form->radio('paymentmode', [
                    ['value' => 'Check', 'text' => 'Check'],
                    ['value' => 'Cash', 'text' => 'Cash'],
                    ],['label' => 'Payment Mode','required' => true,'hiddenField' => false, 'class' => 'payment']);
            echo $this->Form->control('checkno',['required' => false,'placeholder' => 'Check No']);
            echo '<div class="input payselect"><b>ID Type :</b></div>';
            echo $this->Form->radio('idtype', [
                    ['value' => 'Aadhaar', 'text' => 'Aadhaar'],
                    ['value' => 'Pan', 'text' => 'Pan'],
                    ],['label' => 'ID Type','required' => true,'hiddenField' => false, 'class' => 'idtypes']);
            echo $this->Form->control('idno',['required' => 'true','placeholder' => 'ID No']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'login-btn alt']) ?>
    <?= $this->Form->end() ?>
    <script>
        $('#checkno').hide();
        $('#idno').hide();
        $('.payment').click(function(){
            if($('#paymentmode-check').prop('checked'))
                $('#checkno').show();
            else
              {  $('#checkno').hide();

        }});
        $('.idtypes').click(function(){
            if($('#idtype-aadhaar').prop('checked'))
            {    $('#idno').show();
                $('#idno').attr('placeholder','Aadhaar Number');}
            else if($('#idtype-pan').prop('checked'))
            {
                $('#idno').show();
                $('#idno').attr('placeholder','Pan Number');
            }
            else
                $('#idno').hide();
        });
    </script><script>
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
                            }));
                        amount_var = data['amount'];
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
                            $('#booking-amt').val(amount_var * $('.selected-plot').length);
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
