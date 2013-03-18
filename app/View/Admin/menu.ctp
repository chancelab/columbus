<h1>Columbus管理画面</h1>
<ul class="top-menu">
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/AppSettings/edit')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/settings-3.svg', array('alt' => 'App Setting', 'width' => 64, 'height' => 64)); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('App Setting'); ?></span><br />
            <span class="link-info">アプリケーションの基本設定を行います。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/statuses')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/settings-2.svg', array('alt' => 'Manage Status', 'width' => 64, 'height' => 64)); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('Manage Status'); ?></span><br />
            <span class="link-info">ステータスの管理を行います。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/acl')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/key.svg', array('alt' => 'ACL', 'width' => 64, 'height' => 64)); ?></div>
        <div class="link-right">
            <span class="link-title">ACL</span><br />
            <span class="link-info">アクセス制御を管理します。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/users')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/users.svg', array('alt' => 'ユーザー管理', 'width' => 64, 'height' => 64)); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('Manage User'); ?></span><br />
            <span class="link-info">ログインユーザーを管理します。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/InputItems')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/add.svg', array('alt' => '追加入力項目設定')); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('Manage Input Item'); ?></span><br />
            <span class="link-info">アイデアの追加入力項目を設定します。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/tags')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/tag.svg', array('alt' => 'タグ管理')); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('Manage Tag'); ?></span><br />
            <span class="link-info">タグを管理します。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/attachments')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/folder-duplicate.svg', array('alt' => 'ファイル管理')); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('Manage File'); ?></span><br />
            <span class="link-info">アップロードされたファイルを管理します。</span>
        </div>
    </a>
</li>
<li>
    <a href="<?php echo $this->Html->url(array('controller' => 'admin/idea_responses')); ?>">
        <div class="big-icon"><?php echo $this->Html->image('svg/pencil.svg', array('alt' => 'コメント管理')); ?></div>
        <div class="link-right">
            <span class="link-title"><?php echo __('List %s', __('Idea Responses')); ?></span><br />
            <span class="link-info">コメント一覧を管理します。</span>
        </div>
    </a>
</li>
</ul>
