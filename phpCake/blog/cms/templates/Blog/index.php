<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Blog> $blog
 */
?>
<div class="blog index content">
    <?= $this->Html->link(__('New Blog'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Blog') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('short_desc') ?></th>
                    <th><?= $this->Paginator->sort('imgs') ?></th>
                    <th><?= $this->Paginator->sort('blogs') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blog as $blog): ?>
                <tr>
                    <td><?= $this->Number->format($blog->id) ?></td>
                    <td><?= h($blog->title) ?></td>
                    <td><?= h($blog->short_desc) ?></td>
                    <td><?= h($blog->imgs) ?></td>
                    <td><?= h($blog->blogs) ?></td>
                    <td><?= $blog->hasValue('user') ? $this->Html->link($blog->user->username, ['controller' => 'User', 'action' => 'view', $blog->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $blog->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blog->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
