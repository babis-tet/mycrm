<div class="modal fade" id="contactPopup" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Επαφές</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contact">
                    <!-- Row 1 -->
                    <div class="row">
                                    <input type="hidden" id="recordID" value="">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Όνομα *</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                   value="{{ old('name', isset($contact) ? $contact->name : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group has-error">
                                            <label for="surname">Επίθετο *</label>
                                            <input type="text" id="surname" name="surname" class="form-control"
                                                   value="{{ old('surname', isset($contact) ? $contact->surname : '') }}"
                                            >
                                        </div>
                                    </div>
                                </div>

                    <div class="row">
                        <div class="col-12">
                        <div class="form-group">
                                            <label for="name">Θέση *</label>
                                            <input type="text" id="position" name="position" class="form-control"
                                                   value="{{ old('position', isset($contact) ? $contact->position : '') }}">
                                        </div>
                        </div>
                    </div>

                    <div class="row">
                                <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Email *</label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                   value="{{ old('email', isset($contact) ? $contact->email : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="phone">Τηλέφωνο *</label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   value="{{ old('phone', isset($contact) ? $contact->phone : '') }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="mobile">Κινητό *</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control"
                                                   value="{{ old('mobile', isset($contact) ? $contact->mobile : '') }}"
                                            >
                                        </div>
                                    </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveContactBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#contactPopup">
    Nέα Επαφή +
</button>

<div class="dt-responsive table-responsive">
            <table id="mydatatable" class="mydatatable table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Επωνυμία</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
