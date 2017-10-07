   <div class="table-container">
    <table cellpadding="0" cellspacing="0" class="view-table">
        <thead>
            <tr>
                <th scope="col" class="contact-paginate"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="contact-paginate"><?= $this->Paginator->sort('email',['label' => 'Email ID']) ?></th>
                <th scope="col" class="contact-paginate"><?= $this->Paginator->sort('contact') ?></th>
                <th scope="col" class="contact-paginate"><?= $this->Paginator->sort('body') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= h($contact->name) ?></td>
                <td class="email-id-col hover-light"><?= h($contact->email) ?></td>
                <td><?= h($contact->contact) ?></td>
                <td class="message-btn"><i class="fa fa-comment"></i></td>
                <td class="message-body"><?= h($contact->body) ?></td>
                <td>         <center>           <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['prefix' => 'admin','action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id),'escape' => false]) ?></center></td>
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
