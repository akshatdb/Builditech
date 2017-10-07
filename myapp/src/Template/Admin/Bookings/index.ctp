        <center>
    <i class="fa fa-globe fa-5x" aria-hidden="true"></i></center>
    <?= $this->Html->link('<i class="fa fa-close"></i>', ['controller' => 'Pages','action'=>'display','admin'], ['escape' => false, 'class' => 'close-btn']); ?><h1>Manage Bookings</h1>

    <div class="table-container">
    <table cellpadding="0" cellspacing="0" class="view-table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('moba',['label' => 'Mobile 1']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobb',['label' => 'Mobile 2']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('booking_amt',['label' => 'Paid Amount']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col">Confirmed</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= h($booking->id) ?></td>
                <td><?= h($booking->customer_name) ?></td>
                <td><?= h($booking->address) ?></td>
                <td><?= h($booking->email) ?></td>
                <td><?= h($booking->moba) ?></td>
                <td><?= h($booking->mobb) ?></td>
                <td><?= h($booking->booking_amt) ?></td>
                <td><?= h($booking->created) ?></td>
                <?php if($booking->confirmed != 1): ?>
                <td><?= $this->Form->postLink(__('<center><i class="fa fa-close tooltip"></i><span class="tooltiptext">Click to Confirm</span></center>'), ['action' => 'confirm', $booking->id],['escape' => false]) ?></td>
                <?php else: ?>
                <td><?= $this->Form->postLink(__('<center><i class="fa fa-check tooltip"></i><span class="tooltiptext">Click to Unconfirm</span></center>'), ['action' => 'unconfirm', $booking->id],['escape' => false]) ?></td>
                <?php endif; ?>
                <td class="actions">
                    <a class="print-btn" data-id =<?= $booking->id ?> ><i class="fa fa-print"></i><span class="tooltiptext">Print</span></a>
                    <?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i>'), ['action' => 'edit', $booking->id],['escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id),'escape' => false]) ?>
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
    <script>
        $('.tooltiptext').hide();
        $('.tooltip').mouseover(function(){
            $(this).next().show();
        }).mouseout(function(){
            $(this).next().hide();
        });
        function closePrint () {
                document.body.removeChild(this.__container__);
        }
        function setPrint () {
              this.contentWindow.__container__ = this;
              this.contentWindow.onbeforeunload = closePrint;
              this.contentWindow.onafterprint = closePrint;
              this.contentWindow.focus(); // Required for IE
              this.contentWindow.print();
        }
        $('.print-btn').click(function (){ 
                        var oHiddFrame = document.createElement("iframe");
                        oHiddFrame.onload = setPrint;
                        oHiddFrame.style.visibility = "hidden";
                        oHiddFrame.style.position = "fixed";
                        oHiddFrame.style.right = "0";
                        oHiddFrame.style.bottom = "0";
                        oHiddFrame.src = '/admin/bookings/print/'+ $(this).data('id');
                        document.body.appendChild(oHiddFrame);
        });
    </script>
