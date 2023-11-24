<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog $blog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Blog'), ['action' => 'edit', $blog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Blog'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Blog'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Blog'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="blog view content">
            <h3><?= h($blog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($blog->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Short Desc') ?></th>
                    <td><?= h($blog->short_desc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Imgs') ?></th>
                    <td><?= h($blog->imgs) ?></td>
                </tr>
                <tr>
                    <th><?= __('Blogs') ?></th>
                    <td><?= h($blog->blogs) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $blog->hasValue('user') ? $this->Html->link($blog->user->username, ['controller' => 'User', 'action' => 'view', $blog->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($blog->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
