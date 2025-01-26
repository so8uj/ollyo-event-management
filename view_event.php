<?php 
    require_once('includes/frontend/header.php'); 
    include('core/frontend_functions.php');

?>
    <!-- Sweet Alert for Confirm Registration -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(mysqli_num_rows($get_single_event) > 0){ 
        $single_event = mysqli_fetch_assoc($get_single_event); 
        $registered = count_data('event_registrations','event_id',$single_event['id']); 
        $remaining = $single_event['maximum_capacity'] - $registered;
    ?>

        <section class="page-breadcrumb py-5 bg-a">
            <div class="container">
                <h3 class="fs-1 pt-4 fw-semi-bold color-black"><?= $single_event['title'] ?></h3>
                <div class="event-detail pt-3">
                    <ul class="ps-0 d-flex flex-wrap gap-3">
                        <li class="d-flex align-items-center column-gap-2 fw-semi-bold color-black">
                            <img src="./assets/img/icons/calendar-con.webp" alt="Calender Icon"> <?= date('d M, Y',strtotime($single_event['event_date'])) ?>
                        </li>
                        <li class="d-flex align-items-center column-gap-2 fw-semi-bold color-black">
                            <img src="./assets/img/icons/user-icon.webp" alt="Calender Icon"> <?= $single_event['name'] ?>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Events Part -->
        <section class="event-section py-5" id="events">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="event-wrapper">
                            <img src="uploads/<?= $single_event['featured_image'] ?>" class="w-100 img-thumbnail" alt="Event Image">
                            <div class="details mt-4">
                                <?= html_entity_decode($single_event['description']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Registraton Details:</h5><hr>
                                <div class="row gx-2 mb-3">
                                    <div class="col-6">
                                        <div class="card text-center">
                                            <div class="card-body bg-a">
                                                <h6 class="card-title">Total Slots</h6>
                                                <h6 class="card-title"><?= $single_event['maximum_capacity'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card text-center">
                                            <div class="card-body bg-<?= $remaining != 0 ? 'success color-white' : 'warning' ?>">
                                                <h6 class="card-title">Remaining Slots</h6>
                                                <h6 class="card-title"><?= $remaining ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="color-a mb-3">Reserve your slot now</h5>
                                        <?php if($remaining != 0){ ?>
                                            <form id="event_registration_form">
                                                <div class="mb-3 form-group">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                                </div>
                                                <div class="mb-3 form-group">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                                </div>
                                                <input type="hidden" name="event_id" value="<?= $single_event['id'] ?>">
                                                <input type="hidden" name="postRegistrationData">
                                                <div class="d-block">
                                                    <button type="button" class="btn btn-a w-100 form_submit" data-target-form="#event_registration_form" data-method="POST" data-form-action="core/event_registration.php">Confrim Registration</button>
                                                </div>
                                            </form>
                                        <?php }else{ ?>
                                            <h3 class="text-center text-danger">Sorry for Now. <br>Registration Ended</h3>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php }else{ ?>
        <section class="bg-a section-padding">
            <div class="container text-center">
                <h3 class="fs-1 fw-semi-bold mb-4 color-black">No Event Found!</h3>
                <a href="events.php" class="btn btn-dark">View All Events</a>
            </div>
        </section>
    <?php } ?>

    

<?php require_once('includes/frontend/footer.php'); ?>