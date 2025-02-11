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
                <div class="event-wrapper-loader content-center show-loader">
                <div class="text-center">
                    <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <h3 class="mb-5">Loading...</h3>
                </div>
                </div>
                <div class="event-filters mb-5">
                    <div class="row row-gap-2">
                        <div class="col-lg-6">
                            <form class="d-flex justify-content-between align-items-center column-gap-2">
                                <input type="text" class="form-control" id="search_input" placeholder="Search event...">
                                <button type="button" id="search_button" class="btn btn-a-outline">Search</button>
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
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row row-gap-4" id="events-container"></div>
                <div class="text-center mt-4 pt-4 d-none" id="pagination_container">
                    <button class="btn btn-a view_more_botton" data-page="2">View More</button>
                </div>
            </div>
        </div>
    </section>


    <!-- Catch Data With Ajax -->
    <script>
        
        $(document).ready(function () {
            
            function minimise_title(title){
                if (title.length > 40) {
                    return title.substring(0, 39) + '...';
                } else {
                    return title;
                }            
            }
            function make_event_by_group(all_datas, field) {
                const group_array = [];
                all_datas.forEach(data => {
                    const key = data[field];
                    if (!group_array.includes(key)) {
                        group_array.push(key);
                    }
                });
                return group_array;
            }
            function check_select_option(select_element,value) {
                all_options = $(select_element+" option");
                let return_val = false;
                all_options.each(function(){
                    if($(this).val() === value){
                        return_val = true;
                    }
                });
                return return_val;
            }

            function draw_events(events,search=false,search_with=null){
                
                const container = $('#events-container');
                if(search===true){
                    container.html(`
                        <h3 class="fs-4">Showing Search Result with <span class="text-primary">'${search_with}'</span></h3>
                    `);
                    $('#event_by_filter').html(`<option value="default">Event By</option>`);
                }
                if(events){
                    $('#pagination_container').removeClass('d-none');
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
                                            <h5 class="py-3 color-black event_title">${minimise_title(event.title)}</h5>
                                            <a href="view_event.php?name=${event.slug}" class="btn btn-a-outline">Read More</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        `)
                    });
                    all_names_group = make_event_by_group(events,'name');
                    all_names_group.forEach(name_group => {
                        if(!check_select_option('#event_by_filter',name_group)){
                            $('#event_by_filter').append(`<option value="${name_group}">${name_group}</option>`);
                        }
                    });
                }else{
                    $('.view_more_botton').hide(); 
                    $('#event_by_filter').html(`<option value="default">Event By</option>`);
                    container.append(`
                        <p class="text-danger">No Event Found <a href="#"  class="btn-link" onclick="location.reload()">Refresh Page</a></p>
                    `)
                }
            }

            function call_ajax(requested_datas){
                $.ajax({
                    url: 'api/fetch_data.php',
                    type: 'GET',
                    data: requested_datas,
                    dataType: 'json',
                    success: function (response) {
                        if(response.data.events){
                            if (response.data.events && response.data.events.length > 0) {
                                draw_events(response.data.events); 
                            }
                            if (response.data.paginate_button === false || response.data.events.length < requested_datas.limit) {
                                $('.view_more_botton').hide(); 
                            }
                        }else{
                            $('#pagination_container').addClass('d-none');
                            $('#events-container').append(`
                                <p class="text-danger">No Event Found <a href="#"  class="btn-link" onclick="location.reload()">Refresh Page</a></p>
                            `);
                        }
                        if(response.data.search){
                            draw_events(response.data.events,response.data.search,response.data.search_with); 
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching Datas:', error);
                    }
                });
            }

            $(window).on('load',function(){
                $('.event-wrapper-loader').addClass('show-loader');
                call_ajax({
                    table_name:'events',
                    request_for:'all_data',
                    limit: 6,
                    paginate:true,
                    page: 1,
                });
                $('.event-wrapper-loader').removeClass('show-loader');
            });
            $('.view_more_botton').click(function(){
                $('.event-wrapper-loader').addClass('show-loader');
                let page = $(this).data('page');
                $(this).html('Loading...');
                call_ajax({
                    table_name:'events',
                    request_for:'all_data',
                    limit: 6,
                    paginate:true,
                    page:page

                });
                $(this).html('View More');
                $(this).data('page', page + 1);
                $('.event-wrapper-loader').removeClass('show-loader');
            });

            $('#search_button').click(function(){

                if($("#search_input").val() != ""){
                    search_input = $("#search_input").val();
                    $('.event-wrapper-loader').addClass('show-loader');
                    call_ajax({
                        table_name:'events',
                        request_for:'all_data',
                        limit: 100,
                        paginate:false,
                        page:1,
                        search_field: 'title',
                        search_value: search_input
                        
                    });
                    $('.event-wrapper-loader').removeClass('show-loader');
                }else{
                    alert("Please enter event name")
                }
            });

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



