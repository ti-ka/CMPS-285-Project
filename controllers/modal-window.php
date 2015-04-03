<!-- Modal -->
<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Image Preview</h4>
            </div>
            <div class="modal-body">
                <img src="" class="modal-image">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cart-btn" data-item-id="0"><i class="fa fa-cart-plus"></i> &nbsp; Add to Cart</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("body").on("click","img:not(.no-zoom)",function(){
        //Setting title of modal
        if($(this).attr("alt") == ""){
            $("#myModalLabel").html("Image Preview")
        } else {
            $("#myModalLabel").html($(this).attr("alt"))
        }


        if($(this).attr("data-shopping") == "false"){
            $("#modal-image img.modal-image").attr("src",$(this).attr("src"))
            $("#modal-image .cart-btn").hide()
            $("#modal-image").modal()
        } else {
            $("#modal-image img.modal-image").attr("src",$(this).attr("src"))
            $("#modal-image .cart-btn").show()
            $("#modal-image").modal()
        }


    })


</script>