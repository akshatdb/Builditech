    <center>
    <i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', $this->request->referer(), ['escape' => false, 'class' => 'close-btn']); ?><h1><?= ucwords($user->name) ?></h1>
    <div class="table-container user-table-container">   
    <table cellpadding="0" cellspacing="0" class="view-table user-table">
        <tbody>
            <tr>
                <td>User ID</td>
                <td><?= $user->id ?></td>
            </tr>
            <tr>
                <td>Email ID</td>
                <td><?= $user->emailid ?></td>
            </tr>
            <tr>
                <td>Phone No</td>
                <td><?= $user->emailid ?></td>
            </tr>
            <tr>
                <td>Created</td>
                <td><?= $user->created ?></td>
            </tr>
        </tbody>
    </table>
    <?= $this->Html->script('modernizr.js') ?>
    <script>
        if(Modernizr.mq('(min-width: 767px)')){
            $('.user_panel').css({'width':'50%'});
        }
        else{
            $('.user_panel').css({'width':'100%'});
        }
    </script>