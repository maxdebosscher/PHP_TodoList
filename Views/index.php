<div class="row">

    <!-- Existing Lists -->
    <?php foreach ($params[0] as $tasklistKey => $tasklist) { ?>
        <div class="card col-md-3 col-xl-2 px-0 mx-2">
            <div class="card-header d-flex">
                <span class="py-1 mr-auto"><?php print($tasklist->getTitle()); ?></span>
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#listMenuModal<?php print($tasklist->getId()); ?>">Menu</button>

                    <!-- Menu Modal -->
                    <div class="modal" id="listMenuModal<?php print($tasklist->getId()); ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tasklist Menu</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form class="row mb-2 px-3" action="" method="GET">
                                        <input type="hidden" name="tasklistId" value="<?php print($tasklist->getId()); ?>">
                                        <input type="hidden" name="sort" value="<?php print($params[1]); ?>">
                                        <input class="btn btn-primary" type="submit" value="Sort by Duration">
                                    </form>

                                    <form class="row mb-2 px-3" action="" method="GET">
                                        <input type="hidden" name="tasklistId" value="<?php print($tasklist->getId()); ?>">
                                        <label class="col-2 px-0 py-1" for="filter">Filter by:</label>
                                        <select class="form-control col-8" name="filter">
                                            <option>None</option>
                                            
                                            <?php foreach ($params[2] as $statusKey => $status) { ?>
                                                <option><?php print($status["name"]); ?></option>
                                            <?php } ?>

                                        </select>
                                        <input class="btn btn-success col-2" type="submit" value="Submit">
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <button class="btn btn-sm btn-primary mx-1" data-toggle="modal" data-target="#editListModal<?php print($tasklist->getId()); ?>">Edit</button>
                <button class="btn btn-sm btn-danger mx-1" data-toggle="modal" data-target="#deleteListModal<?php print($tasklist->getId()); ?>">Delete</button>
            </div>

            <!-- Edit List Modal -->
            <div class="modal" id="editListModal<?php print($tasklist->getId()); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Tasklist</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="<?php echo htmlspecialchars("/tasklist-update"); ?>" method="POST">
                                <input type="hidden" name="id" value="<?php print($tasklist->getId()); ?>">
                                <div class="row pr-3 mb-2">
                                    <label class="col-2 py-1" for="title">Title:</label>
                                    <input class="col-10 form-control" type="text" name="title" value="<?php print($tasklist->getTitle()); ?>">
                                </div>
                                <input class="btn btn-sm btn-success" type="submit" value="Submit">
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Delete List Modal -->
            <div class="modal" id="deleteListModal<?php print($tasklist->getId()); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Tasklist</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <span>Are you sure?</span>
                            <form action="<?php echo htmlspecialchars("/tasklist-destroy"); ?>" method="POST">
                                <input type="hidden" name="id" value="<?php print($tasklist->getId()); ?>">
                                <input class="mt-2 btn btn-sm btn-danger" type="submit" value="Delete">
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <ul class="list-group">

                    <!-- Existing Tasks -->
                    <?php foreach ($tasklist->getTasks($tasklist->getId()) as $taskKey => $task) { ?>
                        <li class="list-group-item border-0 p-0">
                            <div class="d-flex">
                                <span class="mr-auto"><?php print($task->getDescription()); ?></span>
                                <button class="btn btn-sm btn-primary mx-1" data-toggle="modal" data-target="#editTaskModal<?php print($task->getId()); ?>">Edit</button>
                                <button class="btn btn-sm btn-danger mx-1" data-toggle="modal" data-target="#deleteTaskModal<?php print($task->getId()); ?>">Delete</button>
                            </div>
                            <div><?php print($task->getStatus()); ?></div>
                            <span class="text-secondary"><?php print($task->getDuration()); ?> min</span>
                            <hr>
                        </li>

                        <!-- Edit Task Modal -->
                        <div class="modal" id="editTaskModal<?php print($task->getId()); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Task</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="<?php echo htmlspecialchars("/task-update"); ?>" method="POST">
                                            <input type="hidden" name="id" value="<?php print($task->getId()); ?>">
                                            <input type="hidden" name="tasklistId" value="<?php print($task->getTasklistId()); ?>">
                                            <div class="row pr-3 mb-2">
                                                <label class="col-3 py-1" for="title">Description:</label>
                                                <input class="col-9 form-control" type="text" name="description" value="<?php print($task->getDescription()); ?>">
                                            </div>
                                            <div class="row pr-3 mb-2">
                                                <label class="col-3 py-1" for="title">Duration:</label>
                                                <input class="col-9 form-control" type="text" name="duration" value="<?php print($task->getDuration()); ?>">
                                            </div>
                                            <div class="row pr-3 mb-2">
                                                <label class="col-3 py-1" for="status">Status:</label>
                                                <select class="form-control col-9" name="status">

                                                    <?php foreach ($params[2] as $statusKey => $status) { ?>
                                                        <option><?php print($status["name"]); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <input class="btn btn-sm btn-success" type="submit" value="Submit">
                                        </form>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Delete Task Modal -->
                        <div class="modal" id="deleteTaskModal<?php print($task->getId()); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Task</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <span>Are you sure?</span>
                                        <form action="<?php echo htmlspecialchars("/task-destroy"); ?>" method="POST">
                                            <input type="hidden" name="id" value="<?php print($task->getId()); ?>">
                                            <input class="mt-2 btn btn-sm btn-danger" type="submit" value="Delete">
                                        </form>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    <!-- New Task -->
                    <li class="list-group-item border-0 p-0">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#newTaskModal<?php print($tasklist->getId()); ?>">New Task</button>
                    </li>

                    <!-- New Task Modal -->
                    <div class="modal" id="newTaskModal<?php print($tasklist->getId()); ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">New Task</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars("/task-store"); ?>" method="POST">
                                        <input type="hidden" name="tasklistId" value="<?php print($tasklist->getId()); ?>">
                                        <div class="row pr-3 mb-2">
                                            <label class="col-3 py-1" for="title">Description:</label>
                                            <input class="col-9 form-control" type="text" name="description">
                                        </div>
                                        <div class="row pr-3 mb-2">
                                            <label class="col-3 py-1" for="title">Duration:</label>
                                            <input class="col-9 form-control" type="text" name="duration">
                                        </div>
                                        <div class="row pr-3 mb-2">
                                                <label class="col-3 py-1" for="status">Status:</label>
                                                <select class="form-control col-9" name="status">

                                                    <?php foreach ($params[2] as $statusKey => $status) { ?>
                                                        <option><?php print($status["name"]); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                        <input class="btn btn-sm btn-success" type="submit" value="Submit">
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </ul>
            </div>
        </div>
    <?php } ?>

    <!-- New List -->
    <div class="col-md-3 col-xl-2 px-0 mx-2">
        <form class="my-1 py-2 d-flex" action="<?php echo htmlspecialchars("/tasklist-store"); ?>" method="POST" autocomplete="off">
            <input class="d-inline py-1 px-2 border-0 w-75" type="text" name="title" placeholder="New list" required />
            <input class="btn btn-sm btn-success w-25" type="submit" name="submit" value="Submit" />
        </form>
    </div>

</div>