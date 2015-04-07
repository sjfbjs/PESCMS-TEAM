<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">查看任务</strong> / <small>View Task</small></div>
    </div>

    <hr/>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <h2>
                <?= $title; ?>
            </h2>
            <p>
                <span>
                    #<?= $task_id; ?>
                    <a href="<?= $label->url('Team-Project-task', array('id' => $task_project)) ?>"><span class="am-icon-chain"></span> <?= $label->findProject('project', 'project_id', $task_project)['project_title']; ?></a>
                    <?= $label->taskPriority($task_priority); ?>
                    <?= $label->taskStatus($task_status); ?>
                    <img src="<?= $label->findUser('user', 'user_id', $task_create_id)['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;float: none"/>
                    <a href=""><?= $label->findUser('user', 'user_id', $task_create_id)['user_name']; ?></a>
                    <span>指派给</span>
                    <?php if (empty($task_user_id)): ?>
                        <?= $label->findDepartment('department', 'department_id', $task_department_id)['department_name']; ?> 待审核
                    <?php else: ?>
                        <img src="<?= $label->findUser('user', 'user_id', $task_user_id)['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;float: none"/>
                        <a href=""><?= $label->findUser('user', 'user_id', $task_user_id)['user_name']; ?></a>
                    <?php endif; ?>
                </span>
                <span class="am-fr">
                    创建于：<?= date('Y-m-d', $task_createtime); ?>
                    期望完成时间：<?= date('Y-m-d', $task_expecttime); ?>
                </span>
            </p>
            <hr/>
        </div>
        <!--任务内容-->
        <div class="am-u-sm-12 am-u-sm-centered">
            <?= htmlspecialchars_decode($task_content); ?>

            <?php if (!empty($task_file)): ?>
                <?php foreach (explode(',', $task_file) as $key => $value) : ?>
                    <p>任务附件:<a href="<?= $label->url('Team-SaveFile-index', array('id' => $task_id, 'model' => 'task', 'num' => $key, 'field' => 'file')); ?>">点击下载</a></p>
                <?php endforeach; ?>
            <?php endif; ?>

            <!--任务补充说明-->
            <?php if (!empty($supplement)): ?>
                <?php foreach ($supplement as $key => $value) : ?>
                    <p>---------------任务调整补充(<?= date('Y-m-d', $value['task_supplement_time']); ?>)---------------</p>
                    <?= empty($value['task_supplement_content']) ? '' : htmlspecialchars_decode($value['task_supplement_content']); ?>
                    <?php if (!empty($value['task_supplement_file'])): ?>
                        <?php foreach (explode(',', $value['task_supplement_file']) as $fk => $fv) : ?>
                            <p>附件: <a href="<?= $label->url('Team-SaveFile-index', array('id' => $value['task_supplement_id'], 'model' => 'task_supplement', 'num' => $fk, 'field' => 'file')); ?>">点击下载</a></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <!--任务补充说明-->
            <hr/>
        </div>
        <!--任务内容结束-->

        <!--部门审核指派-->
        <?php include 'Task_view/Task_accept.php'; ?>
        <!--部门审核指派-->

        <!--发起人/审核人操作-->
        <?php include 'Task_view/Task_check.php'; ?>
        <!--发起人/审核人操作-->

        <!--任务动态-->
        <?php include 'Task_view/Task_diary.php'; ?>
        <!--任务动态-->

        <!--执行人操作-->
        <?php include 'Task_view/Task_user.php'; ?>
        <!--执行人操作-->

    </div>
</div>
<!-- content end -->
<script>
    $(function () {
        var umcontent = UM.getEditor('content', {
            toolbar: [
                'source | undo redo | bold italic underline strikethrough | removeformat selectall cleardoc | image'
            ],
            textarea: 'content',
            imageUrl: "/index.php/?g=Team&m=Upload&a=img",
            initialFrameWidth: '100%'
        })
    })
</script>
<link href="/Expand/Form/theme/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Expand/Form/theme/umeditor/lang/zh-cn/zh-cn.js"></script>