<div class="card m-b-30 card-body bubble col-3">
    <div class="modal-header p-0">
        <i class="mdi mdi-message-alert font-20 px-2"></i>
        <h6 class="modal-title mt-0 font-14">Try our Linkedin helper</h6>
        <button type="button" class="close p-0 pr-2" id="close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <p class="card-text pt-1">This extension will make your research on Linkedin a breeze.</p>
    <a href="/extension" class="btn btn-primary waves-effect waves-light">Install</a>
</div>

<script>
$('#close').click(function(){
    $('.bubble').css('display', 'none')
});
</script>

<style>
    .bubble {
        position: sticky !important;
        bottom: 0;
        left: 100%;
        margin: 0;
        z-index: 1030;
    }

    html {
        overflow: visible !important;
    }

</style>
