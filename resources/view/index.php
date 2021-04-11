
<?php
include_once 'layout/header.php';
?>

<div class="container">
    <h1>Contact List <a href="<?php echo url('submit-form') ; ?>" class="float-right btn btn-primary"> Add New </a></h1>


    <table class="table table-striped  table-bordered col-sm-12">
        <thead>
        <tr>
            <th>Amount</th>
            <th>Buyer</th>
            <th>Receipt_id</th>
            <th>items</th>
            <th>buyer_email</th>
            <th>buyer_ip</th>
            <th>note</th>
            <th>city</th>
            <th>phone</th>
            <th>hash_key</th>
            <th>entry_at</th>
            <th>entry_by</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($contacts as $data){
            ?>
            <tr>
                <td><?php echo $data['amount'] ; ?> </td>
                <td><?php echo $data['buyer'] ; ?> </td>
                <td><?php echo $data['receipt_id'] ; ?> </td>
                <td><?php echo $data['items'] ; ?> </td>
                <td><?php echo $data['buyer_email'] ; ?> </td>
                <td><?php echo $data['buyer_ip'] ; ?> </td>
                <td><?php echo $data['note'] ; ?> </td>
                <td><?php echo $data['city'] ; ?> </td>
                <td><?php echo $data['phone'] ; ?> </td>
                <td><button data-hash="<?php echo $data['hash_key'] ; ?>"  class="btn btn-primary show-hash">Show Hash</button> </td>
                <td><?php echo $data['entry_at'] ; ?> </td>
                <td><?php echo $data['entry_by'] ; ?> </td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="showHashModal" tabindex="-1" role="dialog"   aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <p id="hash" style="word-wrap: break-word;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(".show-hash").click(function () {
      let hash =  $(this).data('hash')  ;
      $("#hash").html(hash);
        $("#showHashModal").modal('show')
    })
</script>
<?php
include_once 'layout/footer.php';
?>
