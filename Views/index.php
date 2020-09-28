<div class="row">

    <!-- Existing Lists -->
    <?php foreach ($params as $tasklistKey => $tasklist) { ?>
        <div class="card col-md-3 px-0 mx-2">
            <div class="card-header"><?php print($tasklist->getTitle()); ?></div>
            <div class="card-body">
                <ul class="list-group">

                    <?php foreach ($tasklist->getTasks() as $taskKey => $task) { ?>
                        <li class="list-group-item border-0 p-0">
                            <div class="d-flex">
                                <p class="py-1"><?php print($task->getDescription()); ?></p>
                            </div>
                            <div><?php print($task->getStatus()); ?></div>
                            <span class="text-secondary"><?php print($task->getDuration()); ?> min</span>
                            <hr>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    <?php } ?>

    <!-- New List -->
    <div class="col-md-3 px-0 mx-2">
        <form class="my-1 py-2 d-flex" action="<?php echo htmlspecialchars("/tasklist-store"); ?>" method="POST" autocomplete="off">
            <input class="d-inline py-1 px-2 border-0 w-75" type="text" name="title" placeholder="New list" required />
            <input class="btn btn-sm btn-success w-25" type="submit" name="submit" value="Submit" />
        </form>
    </div>

</div>