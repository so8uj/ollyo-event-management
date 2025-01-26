<?php 
    require_once('includes/frontend/header.php'); 
    include('core/frontend_functions.php');

?>

    <!-- Banner Part  -->
    <section class="banner-area content-center">
        <div class="container">
            <div class="col-lg-6 mx-auto">
                <div class="banner-content">
                    <h1 class="color-white fw-bold mb-5">Search Latest Events</h1>
                    <div>
                        <form class="d-flex justify-content-between align-items-center ">
                            <input type="text" class="form-control custom-search-input" placeholder="Search event...">
                            <button type="submit" class="btn btn-a-outline">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 pt-5 mt-5">
                <div class="d-flex justify-content-end">
                    <a href="#events">
                        <div class="banner-scroll-part content-center position-relative">
                            <img src="./assets/img/icons/arrow-down.webp" class="scroll_arrow-acon" alt="Arrow Icon">
                            <svg viewBox="0 0 100 100" width="100" height="100">
                                <defs>
                                    <path id="circle"
                                    d="
                                        M 50, 50
                                        m -37, 0
                                        a 37,37 0 1,1 74,0
                                        a 37,37 0 1,1 -74,0"/>
                                </defs>
                                <text font-size="14.3">
                                    <textPath xlink:href="#circle">
                                        Scroll Down for Our Latest Events
                                    </textPath>
                                </text>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Events Part -->
    <section class="event-section section-padding" id="events">
        <div class="container">
            <h3 class="section-heading text-center fw-semi-bold color-a">Latest Events</h3>
            <div class="row row-gap-4">
                <?php while($all_event = mysqli_fetch_assoc($all_event_homepage)){ ?> 
                
                    <div class="col-lg-4">
                        <div class="box">
                            <a href="view_event.php?name=<?= $all_event['slug'] ?>">
                                <div class="event-image">
                                    <img src="uploads/<?= $all_event['featured_image'] ?>" class="w-100" alt="Event Image">
                                </div>
                                <div class="event-detail p-3">
                                    <ul class="ps-0 d-flex flex-wrap gap-3">
                                        <li class="d-flex align-items-center column-gap-2 fw-semi-bold color-a">
                                            <img src="./assets/img/icons/calendar-con.webp" alt="Calender Icon"> <?= date('d M, Y',strtotime($all_event['event_date'])) ?>
                                        </li>
                                        <li class="d-flex align-items-center column-gap-2 fw-semi-bold color-a">
                                            <img src="./assets/img/icons/user-icon.webp" alt="Calender Icon"> <?= $all_event['name'] ?>
                                        </li>
                                    </ul>
                                    <h5 class="py-3 color-black"><?= minimise_title($all_event['title']) ?></h5>
                                    <a href="view_event.php?name=<?= $all_event['slug'] ?>" class="btn btn-a-outline">Read More</a>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php } ?>


            </div>
            <div class="text-center mt-4 pt-4">
                <a href="events.php" class="btn btn-a">View All Events</a>
            </div>
        </div>
    </section>


<?php require_once('includes/frontend/footer.php'); ?>