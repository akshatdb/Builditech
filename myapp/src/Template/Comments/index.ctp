<?php use Cake\I18n\Time; ?>
<?php if($comments->count() == 0): ?>
<h3>No comments yet!</h3>
<?php else: ?>
<div>
    <ul>
         <?php foreach ($comments as $comment): ?>
            <li class="comment-box">
              <h3><i class="fa fa-user-circle" style="margin-right:10px"></i><?= $comment->username ?><div class="timestamp">              <?php if($loggedIn): ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash delete-comment"></i>'), ['prefix' => false,'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id),'escape' => false]) ?>
                            <?php endif ?><?= Time::createFromTimestamp($comment->created->timestamp)->timeAgoInWords(); ?></div>
              </h3>
              <p><?= $comment->body ?></p>
            </li>
         <?php endforeach; ?>
    </ul>
</div>
 <div class="paginator">
     <ul class="pagination comment-paginate">
         <?= $this->Paginator->first('<i class="fa fa-angle-double-left"></i>',['escape'=>false]) ?>
         <?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>',['escape'=>false]) ?>
         <?= $this->Paginator->numbers() ?>
         <?= $this->Paginator->next('<i class="fa fa-angle-right"></i>',['escape'=>false]) ?>
         <?= $this->Paginator->last('<i class="fa fa-angle-double-right"></i>',['escape'=>false]) ?>
     </ul>
     <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
 </div>
<?php endif; ?>
