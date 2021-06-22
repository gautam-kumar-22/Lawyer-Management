
<script type="text/javascript">
    function approve_modal(url)
    {
        event.preventDefault();
        jQuery('#confirm-approve').modal('show', {backdrop: 'static'});
        document.getElementById('approve_link').setAttribute('href' , url);
    }
</script>

<div class="modal fade admin-query" id="confirm-approve">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('common.Confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">{{__('common.Are you Sure to execute this operation?')}}</h3>

                <div class="col-lg-12 text-center">
                    <div class="d-flex justify-content-center pt_20">
                        @if (request()->is('pos/pos-order-products') || request()->is( 'purchase/purchase_order/create'))
                            <a id="approve_link" class="primary-btn semi_large2 fix-gr-bg">{{__('common.Yes,Cancel')}}</a>
                        @else
                            <a id="approve_link" class="primary-btn semi_large2 fix-gr-bg">{{__('common.Approve')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
