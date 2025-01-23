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
                <table class="table table-bordered">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Activity</th>
                    <th>Vat</th>
                    <th>Address</th>
                    <tr>
                        <td>Demo Name</td>
                        <td>demo@gmail.com</td>
                        <td>2109999199</td>
                        <td>My activity</td>
                        <td>176534890</td>
                        <td>My address</td>
                    </tr>
                </table>
                <a href="{{ url('/import/customer-import.xlsx') }}" download class="btn btn-secondary">Example File</a>
                <form id="import" class="mt-10">
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
