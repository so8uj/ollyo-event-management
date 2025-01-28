<?php 
    require_once('includes/frontend/header.php'); 
    include('core/frontend_functions.php');

?>

    <section class="page-breadcrumb pt-5 bg-a">
        <div class="container">
            <h1 class="section-heading text-center fw-semi-bold color-black">Ollyo Event Management </h1>
        </div>
    </section>

    <!-- Events Part -->
    <section class="event-section section-padding" id="events">
        <div class="container">
            <div class="custom-card border-0">
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
                <div class="row row-gap-4" id="events-container"></div>
                <div class="text-center mt-4 pt-4" id="pagination_container">
                    <button class="btn btn-a view_more_botton" data-page="2">View More</button>
                </div>
            </div>
        </div>
    </section>


    <!-- Catch Data With Ajax -->
    <script>
        $(document).ready(function(){
            $(document).on('keyup','#search_event',function() {
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
                    $('#events-container').addClass('flex-row-reverse justify-content-end');
                }else{
                    $('#events-container').removeClass('flex-row-reverse justify-content-end');
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
    <script>
        $(document).ready(function () {
            function minimise_title(title){
                if (title.length > 40) {
                    return title.substring(0, 35) + '...';
                } else {
                    return title;
                }            
            }
            function draw_events(events){
                const container = $('#events-container');
                events.forEach(event => {
                   container.append(`
                        <div class="col-lg-4 event-box" data-event-by="${event.name}">
                            <div class="box">
                                <a href="view_event.php?name=${event.slug}">
                                    <div class="event-image">
                                        <img src="uploads/${event.featured_image}" class="w-100" alt="Event Image">
                                    </div>
                                    <div class="event-detail p-3">
                                        <ul class="ps-0 d-flex flex-wrap gap-3">
                                            <li class="d-flex align-items-center column-gap-2 fw-semi-bold color-a">
                                                <img src="./assets/img/icons/calendar-con.webp" alt="Calendar Icon">
                                                ${new Date(event.event_date).toLocaleDateString('en-US', {
                                                    day: '2-digit',
                                                    month: 'short',
                                                    year: 'numeric'
                                                })}
                                            </li>
                                            <li class="d-flex align-items-center column-gap-2 fw-semi-bold color-a">
                                                <img src="./assets/img/icons/user-icon.webp" alt="User Icon">
                                                ${event.name}
                                            </li>
                                        </ul>
                                        <h5 class="py-3 color-black">${minimise_title(event.title)}</h5>
                                        <a href="view_event.php?name=${event.slug}" class="btn btn-a-outline">Read More</a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    `)
                });
            }

            function call_ajax(requested_datas){
                $.ajax({
                    url: 'api/fetch_data.php',
                    type: 'GET',
                    data: requested_datas,
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.data);
                        if (response.data.events && response.data.events.length > 0) {
                            draw_events(response.data.events); 
                        }
                        if (response.data.paginate_button === false || response.data.events.length < requested_datas.limit) {
                            $('.view_more_botton').hide(); 
                        }
                        
                    },
                    error: function (error) {
                        console.error('Error fetching Datas:', error);
                    }
                });
            }

            $(window).on('load',function(){
               
                call_ajax({
                    table_name:'events',
                    request_for:'all_data',
                    limit: 3,
                    paginate:true,
                    page: 1

                });
                
                
            });
            $('.view_more_botton').click(function(){
                let page = $(this).data('page');
                $(this).html('Loading...');
                call_ajax({
                    table_name:'events',
                    request_for:'all_data',
                    limit: 3,
                    paginate:true,
                    page:page

                });
                $(this).html('View More');
                $(this).data('page', page + 1);
            });
        });
    </script>

<?php require_once('includes/frontend/footer.php'); ?>