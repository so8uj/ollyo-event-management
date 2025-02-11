<?php 
    require_once('includes/frontend/header.php'); 
    include('core/frontend_functions.php');

?>

    <section class="page-breadcrumb pt-5 bg-a">
        <div class="container">
            <h1 class="section-heading text-center fw-semi-bold color-black">Ollyo Event <br> Management </h1>
        </div>
    </section>

    <!-- Events Part -->
    <section class="event-section section-padding" id="events">
        <div class="container">
            <div class="custom-card border-0 position-relative">
                
                <div class="event-filters mb-5">
                    <div class="row row-gap-2">
                        <div class="col-lg-6">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" class="d-flex justify-content-between align-items-center column-gap-2">
                                <input type="text" class="form-control" name="search" id="search_input" placeholder="Search event..." required>
                                <button type="submit" id="search_button" class="btn btn-a-outline">Search</button>
                            </form>
                        </div>
                        <div class="col-lg-1"></div>
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

                <div class="row row-gap-4" id="events-container">
                    <?php if(isset($_GET['search']) && $_GET['search'] != null){ ?> 
                        <h3 class="fs-4">Showing Search Result with <span class="text-primary">'<?= $_GET['search'] ?>'</span></h3>
                    
                    <?php } if(count($get_all_events) > 0){
                        foreach($get_all_events as $all_event){ ?> 
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
                        
                    <?php }else{ ?>
                        <p class="text-danger">No Event Found <a href="home-raw-data.php" class="btn-link" >Refresh Page</a></p>
                    <?php } ?>

                </div>
                <?php $pagination_count = ceil($count_events/$view_limit);

                if($view_limit <= $count_events){ ?>
                    
                    <div class="d-flex justify-content-center flex-wrap">
                        <ul class="pagination mb-0 flex-wrap mt-5">
                            <li class="page-item <?= $current_page == 1 ? 'disabled' : '' ?>"><a href="?page=<?= $current_page != 1 ? $current_page-1 : 1 ?>" class="page-link">Previous</a></li>
                            <?php for($page_no = 1; $page_no <= $pagination_count;$page_no++){ ?>
                                <li class="page-item <?= $current_page == $page_no ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $page_no ?>"><?= $page_no; ?></a></li>
                            <?php } ?>
                            <li class="page-item <?= $current_page == $pagination_count ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $current_page != $pagination_count ? $current_page+1 : $pagination_count ?>">Next</a></li>
                        </ul>
                    </div>

                <?php } ?>
                
            </div>
        </div>
        
    </section>

    <script>
        
        $(document).ready(function () {
            
            $('#sort_events').change(function(){
                if($(this).val() == 'asc'){
                    $(".event-box").each(function (index, item) {
                        $(item).css("order", $(".event-box").length - index);
                    });
                }else{
                    $(".event-box").each(function (index, item) {
                        $(item).css("order", "1");
                    });
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
