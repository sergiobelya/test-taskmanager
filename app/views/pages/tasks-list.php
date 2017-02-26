
<div class="row box">

	<div class="box-header with-border">
		<h3 class="box-title">Список всех задач</h3>
	</div>
	<table id="tasks_list" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Имя</th>
                <th>E-mail</th>
				<th>Фото</th>
				<th>Текст задачи</th>
				<th>Статус</th>
				<!--<th></th>-->
			</tr>
		</thead>
		<tbody>
<?php $attrs = 'class="ajax hidden-xs" data-toggle="tooltip"'; ?>
<?php foreach ($tasks as $task) : ?>
			<tr>
				<td><?= e($task->username) ?></td>
                <td><?= e($task->email) ?></td>
				<td>
<?php if ($task->photo) : ?>
					<figure style="height: 25px; width: 25px; overflow: hidden;">
						<img src="<?= $task->photo('photo', '50x50') ?>" style="position: absolute; max-height: 25px; max-width: 25px;" />
					</figure>
<?php endif; ?>
				</td>
                <td><?= nl2br(e($task->task_body)) ?></td>
				<td><?= $task->executed_at ?></td>
<!--				<td><a href="<?= uri("tasks/edit/{$task->id}/") ?>"
					   <?= $attrs ?> title="Редактировать задачу <?= htmlspecialchars($task->name) ?>"><i class="fa fa-edit"></i></a></td>-->
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<div class="box-footer">
		<a href="<?= uri('tasks/create/') ?>"
		   class="ajax btn btn-primary btn-success pull-left"
		   ><i class="fa fa-plus btn-icon"></i>Создать новую задачу</a>
	</div>
</div>

<script>
    $script.ready('common-func', function() {
        dataTableInit('#tasks_list', {
            "columns": [
                null
                , null
                , { "orderable": false }
                , { "orderable": false }
                , null
//                { "orderable": false }
            ]
        });
    });
</script>
