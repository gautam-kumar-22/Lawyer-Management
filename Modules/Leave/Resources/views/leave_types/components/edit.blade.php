<div id="edit_item_modal">
    <div class="modal fade" id="item_edit">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ __('common.Update') }}
                        {{ __('leave.Leave Type') }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <div class="modal-body item_edit_form">
                    <input type="hidden" name="id" id="item_id">
                    @include('leave::leave_types.components.form',['form_id' => 'item_edit_form', 'button_level_name' => __('common.Update') ])
                </div>
            </div>
        </div>
    </div>
</div>
