<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projects index large-9 medium-8 columns content">
    <h3><?= __('Projects') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_addr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plotno') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maplocation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= $project->has('project') ? $this->Html->link($project->project->project_id, ['controller' => 'Projects', 'action' => 'view', $project->project->project_id]) : '' ?></td>
                <td><?= h($project->company_name) ?></td>
                <td><?= h($project->project_name) ?></td>
                <td><?= h($project->project_addr) ?></td>
                <td><?= h($project->plotno) ?></td>
                <td><?= h($project->maplocation) ?></td>
                <td><?= $project->has('customer') ? $this->Html->link($project->customer->name, ['controller' => 'Customers', 'action' => 'view', $project->customer->id]) : '' ?></td>
                <td><?= h($project->created) ?></td>
                <td><?= h($project->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $project->project_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->project_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->project_id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->project_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>
