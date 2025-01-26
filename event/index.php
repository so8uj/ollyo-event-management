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
        <div class="card-body">
            <h3 class="mb-4"><?= $auth['role'] == 0 ? 'My' : 'All' ?> Events</h3>
            <table id="eventsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Featured Image</th>
                        <th>Date</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#eventsTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    type: 'GET',
                    url: '../core/fetch_datatable.php',
                    data:{
                        'table_name':'events',
                        'type':'events'
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
                    { data: 'event_date' },
                    { data: 'maximum_capacity' },
                    { data: 'id',
                        render: function(data,type,row){
                            
                            action_buttons = `
                                <a href="" class="btn btn-sm btn-a">View</a>
                                <a href="" class="btn btn-sm btn-primary">Attendies ${row.attendies}</a>
                                <a href="create.php?action=update&event_id=${data}" class="btn btn-sm btn-warning">Update</a>
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
        });


        
    </script>

    
</div>






<?php require_once('../includes/backend/footer.php'); ?>