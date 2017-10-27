   <h1>Manage Videos</h1>
       <?= $this->Html->link('<i class="fa fa-close"></i>', $this->request->referer(), ['escape' => false, 'class' => 'close-btn']); ?>
   <div class="table-container">
    <table cellpadding="0" cellspacing="0" class="view-table">
        <thead>
            <tr>
                <th scope="col" class="contact-paginate"><?= $this->Paginator->sort('video_name') ?></th>
                <th scope="col" class="contact-paginate"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videos as $video): ?>
            <tr>
                <td><?= h($video->video_name) ?></td>
                <td><?= h($video->created) ?></td>
                <td><?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['prefix' => 'admin','action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete {0}?', $video->video_name),'escape' => false]) ?>
                    <a style = "margin-left:10px" target="_blank" href = "<?=$video->video_link?>"><i class="fa fa-external-link"></i></a></td>                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table></div>
    <div class="paginator">
        <ul class="pagination contact-paginate">
            <?= $this->Paginator->first('<i class="fa fa-angle-double-left"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fa fa-angle-right"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->last('<i class="fa fa-angle-double-right"></i>',['escape'=>false]) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
