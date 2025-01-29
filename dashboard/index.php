<?php 
    require_once('../includes/backend/header.php'); 
    require_once('../core/query_functions.php'); 
?>

<div class="event-container">
    <div class="card">
        <div class="card-body p-5">
            <h2>Welcome, <?= $auth['name'] ?></h2>

            <div class="row mt-4">

                <?php if($auth['role'] == 1){ ?> 
                    <div class="col-lg-3">
                        <div class="card text-bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <h2><?= count_data('users') - 1 ?></h2>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-lg-3">
                    <a href="../event/">
                        <div class="card text-bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $auth['role'] == 1 ? 'Total' : 'My' ?> Events</h5>
                                <h2><?= $auth['role'] == 1 ? count_data('events') : count_data('events','created_by',$auth['id']) ?></h2>
                            </div>
                        </div>
                    </a>
                </div>

                <?php if($auth['role'] == 1){ ?> 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="card-body event-table-wrapper">
                                <h3 class="mb-4">All Users</h3>
                                <table id="users_table" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Registration Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</div>

<?php if($auth['role'] == 1){ ?> 

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    url: '../core/fetch_datatable.php',
                    data:{
                        'type':'users',
                        'table_name':'users',
                    }
                },
                order: [[0, 'desc']],
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'username'},
                    { data: 'role' ,
                        render: function (data) {
                            return data == 1 ? 'Admin' : 'User';
                        }  
                    },
                    { data: 'created_at',
                        render: function(data){
                            let date = new Date().toDateString().toString();
                            date = date.replaceAll(" ", '-');
                            date = date.replace("-", ', ');
                            return date;
                        }
                    }
                ]
                
                

            });


        });
    </script>

<?php } 


require_once('../includes/backend/footer.php'); ?>