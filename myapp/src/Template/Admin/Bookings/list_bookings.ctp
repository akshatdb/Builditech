	<?php if($bookings->count() == 0): ?>
		<b>No Unconfirmed Bookings</b>
	<?php else: ?>
    <div class="table-container">
    <table cellpadding="0" cellspacing="0" class="view-table">
        <thead>
            <tr>
                <th scope="col" class="booking-paginate"><?= $this->Paginator->sort('customer_name') ?></th>
                <th scope="col" class="booking-paginate"><?= $this->Paginator->sort('booking_amt',['label' => 'Paid Amount']) ?></th>
                <th scope="col" class="booking-paginate"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" >Confirmed</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= h($booking->customer_name) ?></td>
                <td><?= h($booking->booking_amt) ?></td>
                <td><?= h($booking->created) ?></td>
                <?php if($booking->confirmed != 1): ?>
                <td><?= $this->Form->postLink(__('<center><i class="fa fa-close tooltip"></i><span class="tooltiptext">Click to Confirm</span></center>'), ['action' => 'confirm', $booking->id],['escape' => false]) ?></td>
                <?php else: ?>
                <td><?= $this->Form->postLink(__('<center><i class="fa fa-check tooltip"></i><span class="tooltiptext">Click to Unconfirm</span></center>'), ['action' => 'unconfirm', $booking->id],['escape' => false]) ?></td>
                <?php endif; ?>
                <td>         <center>           <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id),'escape' => false]) ?></center></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table></div>
    <div class="paginator">
        <ul class="pagination booking-paginate">
            <?= $this->Paginator->first('<i class="fa fa-angle-double-left"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fa fa-angle-right"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->last('<i class="fa fa-angle-double-right"></i>',['escape'=>false]) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div><?php endif; ?>