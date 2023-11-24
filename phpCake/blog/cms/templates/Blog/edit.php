<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog $blog
 * @var string[]|\Cake\Collection\CollectionInterface $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading">
                <?= __('Actions') ?>
            </h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $blog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Blog'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="blog form content">
            <?= $this->Form->create($blog, ['type' => 'file']) ?>

            <fieldset>
                <legend>
                    <?= __('Edit Blog') ?>
                </legend>
                <?php
                echo $this->Form->control('title');
                echo $this->Form->control('short_desc');
                echo $this->Form->control('imgs', ['type' => 'file']);
                echo $this->Form->textarea('blogs', ['rows' => '5']);
                echo $this->Form->control('user_id', ['options' => $user]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>