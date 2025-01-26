<?php 
    require_once('../includes/backend/header.php'); 
    require_once('../core/query_functions.php'); 
    $form_type = 'add';
    if(isset($_GET['action'])){
        $form_type = 'update';
        $event_id = $_GET['event_id'];
        $get_data = get_single_data('events','id',$event_id);
        if(!mysqli_num_rows($get_data) > 0){
            header("Location: create.php");
            exit;
        }
        $single_event = mysqli_fetch_assoc($get_data);
    }

?>

<div class="event-container">
    <div class="alert alert-success d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Event Management</h4>
        <a href="index.php" class="btn btn-a">Manage Events</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="mb-4"><?= $form_type == 'add' ? 'Add' : 'Update' ?> Event</h3>
            <?php include('event_form.php'); ?>
        </div>
    </div>

</div>
    
<script>
    
    $(document).ready(function() {
        $('#description').summernote({
            placeholder: 'Event Description',
            height: 100
        });
        $('#featured_image').change(function(){
            if(this.files && this.files[0]){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview_image').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>

<?php require_once('../includes/backend/footer.php'); ?>