<div wire:init="openModal" wire:ignore.self class="modal fade" id="delete_item" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('role.delete') {{ $item_name }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('common.Are you sure to delete ?')</h4>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <input type="submit" wire:click='delete' class="primary-btn fix-gr-bg" value="Delete"/>
                </div>
            </div>

        </div>
    </div>
</div>

