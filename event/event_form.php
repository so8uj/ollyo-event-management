    <form action="#" id="event_form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-7">
                <div class="mb-3 form-group">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $form_type == 'update' ? $single_event['title'] : '' ?>" placeholder="title" >
                </div>
                <div class="mb-3 form-group">
                    <label for="description" class="form-label">Event Description</label>
                    <textarea name="description" class="form-control editor" rows="5" id="description"><?= $form_type == 'update' ? $single_event['description'] : '' ?></textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="maximum_capacity" class="form-label">Registration Maximum Maximum Capacity</label>
                    <input type="number" class="form-control" id="maximum_capacity" name="maximum_capacity" value="<?= $form_type == 'update' ? $single_event['maximum_capacity'] : '' ?>" placeholder="0" >
                </div>
                <div class="mb-3 form-group">
                    <label for="date" class="form-label">Event Date</label>
                    <input type="date" class="form-control" id="event_date" value="<?= $form_type == 'update' ? $single_event['event_date'] : '' ?>" name="event_date" placeholder="0" >
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mb-4">
                    <img src="../uploads/<?= $form_type == 'update' ? $single_event['featured_image'] : 'default_image.jpg' ?>" id="preview_image" class="img-thumbnail w-100" alt="">
                </div>
                <div class="mb-3 form-group">
                    <label for="featured_image" class="form-label">Event Featured Image</label>
                    <input type="file" class="form-control" id="featured_image" name="featured_image" placeholder="featured_image" <?= $form_type == 'add' ? 'required' : '' ?>>
                    <small class="text-primary fw-bold">Maintain the Image Height Ratio Minimum 260px</small>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="d-block">
                    <input type="hidden" name="created_by" value="<?= $auth['id'] ?>">
                    <input type="hidden" name="event_from_action" value="<?= $form_type == 'add' ? 'add' : 'update' ?>">

                    <?php if($form_type == 'update'){ ?> 
                        <input type="hidden" name="event_id" value="<?= $single_event['id'] ?>">
                        <input type="hidden" name="old_image_name" value="<?= $single_event['featured_image'] ?>">
                    <?php } ?>

                    <button type="button" class="btn btn-a w-100 form_submit" data-target-form="#event_form" data-method="POST" data-form-action="../core/event.php"><?= $form_type == 'add' ? 'Add' : 'Update' ?> Event</button>
                </div>
            </div>
        </div>
    </form>