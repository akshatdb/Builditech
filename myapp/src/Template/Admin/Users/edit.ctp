<h1>Edit <?= ucwords($role) ?></h1> 
<?= $this->Form->create(); ?>
    <?= $this->Form->input('name',['placeholder' => 'Name']); ?>
    <?= $this->Form->input('emailid',['placeholder' => 'Email ID']); ?><img height='15px' width='15px' style="margin:0px 15px;" src='/images/loading.gif' id="checking-gif"/>   
    <?= $this->Form->input('phoneno',['placeholder' => 'Mobile No']); ?>
    <?= $this->Form->input('password',['type' => 'password','placeholder' => 'Password']); ?>
    <?= $this->Form->input('role',['placeholder' => 'Role','readonly'=>true,'value'=>$role,'type'=>'hidden']); ?>
    <?= $this->Form->submit('Register ', ['class' => 'login-btn alt']); ?>
<?= $this->Form->end(); ?>
<?= $this->Html->script('modernizr.js') ?>
<script>
    $('#checking-gif').hide();
    $('#emailid').on('change',function(){
                $('#checking-gif').attr('src','/images/loading.gif');
                $('#checking-gif').fadeIn();
                if(Modernizr.mq('(min-width: 767px)')){
                    $('#emailid').parent().css({
                    'display':'inline-block',
                    'width':'90%'
                });
                }
                else{
                    $('#emailid').parent().css({
                    'display':'inline-block',
                    'width':'80%'
                });
                }
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(regex.test($('#emailid').val()))
                $.ajax({
                    type: "POST",
                    header: {'X-CSRF-TOKEN' : this.csrfToken},
                    url: '/admin/users/checkAvailable',
                    data: {
                        "emailid" : $('#emailid').val(),
                        "_csrfToken": '<?= $this->request->params['_csrfToken'] ?>'
                        },
                    success: function(data){
                        if(data['check'].length == 0)
                        {
                            $('#checking-gif').attr('src','/images/correct.jpg');
                            $('.login-btn').prop('disable',false);
                            $('.login-btn').css({'background-color':'#626262','color':'white'});
                        }
                        else
                        {
                            $('#checking-gif').attr('src','/images/incorrect.jpg');
                            $('.login-btn').prop('disabled',true);
                            $('.login-btn').css({'background-color':'white','color':'black'});
                        }
                    }
                        ,
                    dataType: 'json'
                });
                else
                {
                            $('#checking-gif').attr('src','/images/incorrect.jpg');
                            $('.login-btn').prop('disabled',true);
                            $('.login-btn').css({'background-color':'white','color':'black'});
                }

    });
    setInterval(function (){
        if($('#checking-gif').attr('src') == '/images/correct.jpg')
        {
                $('#checking-gif').fadeOut('fast');
                $('#emailid').parent().css({
                    'display':'inline-block',
                    'width':'100%'
                });
        }
    },10000);
</script>