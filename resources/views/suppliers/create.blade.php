
<div class="modal-body">
    <form id="Edit_supplier_Form" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="hidden" id="supplier_id">
            <input type="text" class="form-control" id="edit_suppliername" name="edit_suppliername"
                placeholder="SupplierName">
            <div class="text-start text-danger edit_suppliername"></div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="edit_supplier_contact_name" name="edit_supplier_contact_name"
                placeholder="Supplier Contact Name">
            <div class="text-start text-danger edit_supplier_contact_name"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="edit_address_line_1" name="edit_address_line_1"
                placeholder="Address Line 1">
            <div class="text-start text-danger edit_address_line_1"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="edit_address_line_2" name="edit_address_line_2"
                placeholder="Address Line 2">
            <div class="text-start text-danger edit_address_line_2"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="edit_address_line_3" name="edit_address_line_3"
                placeholder="Address Line 3">
            <div class="text-start text-danger edit_address_line_3"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="city" name="city"
                placeholder="City">
            <div class="text-start text-danger edit_city"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="state" name="state"
                placeholder="State">
            <div class="text-start text-danger edit_state"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="pincode" name="pincode"
                placeholder="Pincode">
            <div class="text-start text-danger edit_pincode"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="country" name="country"
                placeholder="Country">
            <div class="text-start text-danger edit_country"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="gstin" name="gstin"
                placeholder="GSTIN">
            <div class="text-start text-danger edit_gstin"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="website" name="website"
                placeholder="Website">
            <div class="text-start text-danger edit_website"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="email" name="email"
                placeholder="Email">
            <div class="text-start text-danger edit_email"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="mobileno" name="mobileno"
                placeholder="MobileNo">
            <div class="text-start text-danger edit_mobileno"></div>
        </div>
       <div class="form-group">
            <input type="text" class="form-control" id="phoneno" name="phoneno"
                placeholder="PhoneNo">
            <div class="text-start text-danger edit_phoneno"></div>
        </div>
        <div class="form-group">
            <select name="edit_status" id="edit_status" class="form-control form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <div class="text-start text-danger edit_status"></div>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <button class="btn btn-primary m-1">Update</button>
            <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
        </div>
    </form>
</div>