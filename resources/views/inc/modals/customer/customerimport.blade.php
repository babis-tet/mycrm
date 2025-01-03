<div class="modal fade" id="customerImportModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Import Πελατών</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="import">
                    <div class="form-group">
                    <label for="customerInputFile">Αρχείο (.xls, csv)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customerInputFile">
                        <label class="custom-file-label" for="customerInputFile">επιλογή αρχείου</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="uploadfile">Upload</span>
                      </div>
                    </div>
                  </div>
                </form>
                <div id="response"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Άκυρο</button>
{{--                <button type="button" class="btn btn-primary" id="saveContactBtn">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
