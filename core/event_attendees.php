<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['auth'])){
    header("Location: ../login.php");
}


include('query_functions.php');
$event_id = $_GET['event_id'];
// $all_events = get_all_data('events');
$get_event = get_single_data('events','id',$event_id);
$all_attendees = get_single_data('event_registrations','event_id',$event_id);
$event = mysqli_fetch_assoc($get_event);
$sl_no = 1;
?>


<div class="d-flex justify-content-between flex-wrap align-items-end mb-3">
    <span class="fs-6 fw-bold">Total Attendee: <?= count_data('event_registrations','event_id',$event_id); ?></span>
    <button class="btn btn-a" id="export_report_button" data-export-name="<?= $event['title']; ?>">Downlaod Report</button> 
</div>



<input type="text" class="form-control mb-3" id="search_input" placeholder="Search attenedee by Name or Email">


<table class="table table-sm table-bordered" id="attendee_table">
    <tr>
        <th colspan="4" class="text-center">    
            <?= $event['title'] ?> <br>
            Attendee Lists
        </th>
    </tr>
    
    <tr>
        <th>SL</th>
        <th colspan="2">Name</th>
        <th>Email</th>
    </tr>
    <?php while($attendee = mysqli_fetch_assoc($all_attendees)){ ?>
        <tr class="attendee_row">
            <td><?= $sl_no ?></td>
            <td class="attendee_name" colspan="2"><?= $attendee['name'] ?></td>
            <td class="attendee_email"><?= $attendee['email'] ?></td>
        </tr>
    <?php $sl_no++; } ?>
</table>


<script>

    function download_csv(csv, filename) {
        var csvFile = new Blob([csv], { type: "text/csv" });
        var downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }

    function export_table_to_csv(tableId, filename) {
        var csv = [];
        var rows = $("#" + tableId + " tr"); 
        rows.each(function () {
            var row = [];
            $(this)
                .find("td, th")
                .each(function () {
                    row.push($(this).text()); 
                });
            csv.push(row.join(","));
        });

        download_csv(csv.join("\n"), filename);
    }

    $("#export_report_button").on("click", function () {
        var name = $(this).data('export-name');
        export_table_to_csv("attendee_table", name+"Attendee Lists.csv");
    });

    $('#search_input').keyup(function() {
        var search_with = $(this).val().toLowerCase(); 
        if(search_with != ''){
            $('.attendee_row').each(function() {
                var attendee_name = $(this).find('.attendee_name').text().toLowerCase();
                var attendee_email = $(this).find('.attendee_email').text().toLowerCase();
                if (attendee_name.includes(search_with) || attendee_email.includes(search_with)) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
            });
        }else{
            $('.attendee_row').removeClass('d-none');
        };
    });


</script>



