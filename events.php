<?php 
    require_once('includes/frontend/header.php'); 
    include('core/frontend_functions.php');
?>

    <section class="page-breadcrumb py-5 bg-a">
        <div class="container">
            <h3 class="fs-1 text-center fw-semi-bold color-black">Latest Events</h3>
        </div>
    </section>
    <!-- Events Part -->
    <section class="event-section section-padding" id="events">
        <div class="container">
            <div class="event-filters mb-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search_event" placeholder="Search event...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" id="sort_events">
                            <option value="default" selected>Sort Events</option>
                            <option value="desc">Latest First</option>
                            <option value="asc">Oldest First</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        
                        <select class="form-select" id="event_by_filter">

                            <option value="default" selected>Event By</option>
                            <?php 
                                $get_all_events= mysqli_fetch_all($all_events, MYSQLI_ASSOC); 
                                $all_users = make_group($get_all_events,'name');
                                foreach($all_users as $user){ ?> 
                                    <option><?= $user[0] ?></option>
                            <?php } ?> 
                    
                        </select>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4" id="main-event-wrapper">
                <?php foreach($get_all_events as $all_event){ ?> 
                    <div class="col-lg-4 event-box" data-event-by="<?= $all_event['name'] ?>">
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
                                    <h5 class="py-3 color-black event_title"><?= minimise_title($all_event['title']) ?></h5>
                                    <a href="view_event.php?name=<?= $all_event['slug'] ?>" class="btn btn-a-outline">Read More</a>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php } ?>


            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){


            $('#search_event').keyup(function() {
                var search_with = $(this).val().toLowerCase(); 
                $('.event-box').each(function() {
                    var event_title = $(this).find('.event_title').text().toLowerCase(); 

                    if (event_title.includes(search_with)) {
                        $(this).removeClass('d-none');
                    } else {
                        $(this).addClass('d-none');
                    }
                });
            });

            $('#sort_events').change(function(){
                if($(this).val() == 'asc'){
                    $('#main-event-wrapper').addClass('flex-row-reverse');
                }else{
                    $('#main-event-wrapper').removeClass('flex-row-reverse');
                }
            });
            $('#event_by_filter').change(function(){
                var event_by_filter = $(this).val();
                if(event_by_filter != 'default'){
                    $('.event-box').addClass('d-none');
                    var filterd_item = $(".event-box[data-event-by='" + event_by_filter + "']");
                    filterd_item.each(function() {
                        $(this).removeClass('d-none');
                    });
                }else{
                    $('.event-box').removeClass('d-none');
                }
            });
        });
    </script>


<?php require_once('includes/frontend/footer.php'); ?>