<?php require_once('../includes/backend/header.php'); ?>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<div class="event-container">
    
    <div class="alert alert-success d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Event Management</h4>
        <a href="create.php" class="btn btn-a">Add Event</a>
    </div>
    <?php if(isset($_GET['action'])){
        require_once('../includes/message_alerts.php');
    } ?>

    <div class="card">
        <div class="card-body event-table-wrapper">
            <h3 class="mb-4"><?= $auth['role'] == 0 ? 'My' : 'All' ?> Events</h3>
            <table id="events_table" class="display wrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Featured Image</th>
                        <?php if($auth['role'] == 1){ ?> 
                            <th>Created By</th>
                        <?php } ?>
                        <th>Date</th>
                        <th>Capacity</th>
                        <th>Attendees</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    

    <!-- Modal for View Attendie-->
    <div class="modal fade" id="attendee_modal" tabindex="-1" aria-labelledby="attendeeModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body modal-dynamic-content"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm modal_close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/preloader_middle_body.js"></script>
    <script>
        $(document).ready(function () {
            $('#events_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    url: '../core/fetch_datatable.php',
                    data:{
                        'type':'events',
                        'table_name':'events'
                    }
                },
                order: [[0, 'desc']],
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'featured_image',
                        render: function (data) {
                            return "<img src='../uploads/"+data+"' class='img-thumbnail' width='100px' />";
                        } 
                    },
                    <?= ($auth['role'] == 1) ? "{ data: 'name'}," : null ?>
                    { data: 'event_date' },
                    { data: 'maximum_capacity' },
                    { data: 'attendees' },
                    { data: 'id',
                        render: function(data,type,row){
                            
                            action_buttons = `
                                <button class="btn btn-sm btn-primary view_attendee" data-target-id="${data}">View/Downlaod Attendees</button>
                                <a href="create.php?action=update&event_id=${data}" class="btn btn-sm btn-warning">View/Update</a>
                                <button class="btn btn-sm btn-danger delete-btn" data-target-table="events" data-target-id="${data}" data-target-msg="Event" data-delete-img="${row.featured_image}">Delete</button>
                            `;
                            return action_buttons;
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: [0],
                        orderData: [0, 1]
                    },
                    {
                        targets: [1],
                        orderData: [1, 0]
                    },
                    {
                        targets: [3],
                        orderData: [3, 0]
                    },
                    {
                        targets: [4],
                        orderData: [4, 0]
                    },
                    {
                        targets: [2, 5],
                        orderable: false
                    }
                ],
                createdRow: function (row, data) {
                    $(row).attr('id', 'row-' + data.id);
                },
                search: {
                    smart: true 
                },
                initComplete: function () {
                    $('input[type="search"]').attr('placeholder', 'Search by Titile or Date');
                },
                searchCallback: function (settings, data) {
                    let searchValue = settings.oPreviousSearch.sSearch.toLowerCase();
                    let title = data[1].toLowerCase(); 
                    let eventDate = data[3].toLowerCase(); 
                    return title.includes(searchValue) || eventDate.includes(searchValue);
                }

            });
            $(document).on('click','.view_attendee',function(){
                preloader_start('Please Wait...');
                event_id = $(this).data('target-id');
                $('.modal-dynamic-content').load('../core/event_attendees.php?event_id='+event_id,function(){
                    
                    preloader_end();
                });
                $('#attendee_modal').modal('show');
            });
            $('modal_close').click(function(){
                $('.modal-dynamic-content').html("");
            });


        });
    </script>

</div>






<?php require_once('../includes/backend/footer.php'); ?>