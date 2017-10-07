        <center>
    <i class="fa fa-globe fa-5x" aria-hidden="true"></i></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', ['controller' => 'Pages','action'=>'display','admin'], ['escape' => false, 'class' => 'close-btn']); ?><h1>Manage Projects</h1>

    <div class="table-container">
    <table cellpadding="0" cellspacing="0" class="view-table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('project_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_addr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= h($project->project_name) ?></td>
                <td><?= h($project->project_addr) ?></td>
                <td><?= h($project->created) ?></td>
                <td><?= h($project->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['prefix' => false,'controller' => 'projects','action' => 'view', $project->id],['escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i>'), ['action' => 'edit', $project->id],['escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-picture-o"></i>'),['controller' => 'Images','action'=> 'add',$project->id],['escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->project_name),'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table></div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
