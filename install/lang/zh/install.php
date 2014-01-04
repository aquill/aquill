<?php

return array(

    'title' => '安装 Aquill',

    'start' => '语言和时区',
    'database' => '数据库安装',
    'metadata' => '个性化设置',
    'rewrite' => '友好化的链接',
    'account' => '创始人信息',
    'all_done' => '完成安装',

    'back' => '&laquo; 返回',
    'next' => '下一步 &raquo;',
    'complete' => '完成',

    'language_error' => '请选择一种语言。',
    'account_error' => '帐号输入错误。',
    'not_writeable' => '<code>aquill/config</code> 目录不可写，如果你设置好了那就 <a href="'.url('start').'">再试一次</a> 吧。',

    'halt' => '糟糕！',
    'again' => '再试一次',

    'installed' => '配置文件 <code>aquill/config/database.php</code> 已存在。 
                    如果你需要重新安装，请删除它，如果你准备好了，可以 <a href="'.url('start').'">重试一次</a>。',
);