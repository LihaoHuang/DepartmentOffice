<!-- Modal -->
<div class="modal fade" id="AddForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">新增</h4>
            </div>
            @yield('AddForm')
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="EditForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">編輯</h4>
            </div>
            @yield('EditForm')
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="DelForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">你確定要移除嗎？</h4>
            </div>
            @yield('DelForm')
        </div>
    </div>
</div>