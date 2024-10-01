<?php
    include('includes/guest_header.php');
?>
    <div class="container">
        <form method="POST" id="form" class="card my-3" enctype="multipart/form-data">
            <div class="card-body">
                <div class="text-center m-4">
                    <p class="m-0">Picture</p>
                    <div class="row align-items-center justify-content-center">
                        <span class="avatar avatar-xl" style="background-image: url('<?= images('user.jpg') ?>')"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstName" placeholder="Enter First Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middleName" placeholder="Enter Middle Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastName" placeholder="Enter Last Name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" placeholder="Enter Address" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contactNumber" placeholder="Enter Contact Number" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Picture</div>
                    <input type="file" class="form-control" name="avatar" accept=".png, .jpg, .jpeg" name="picture">
                </div>
                <div class="mb-3">
                    <div class="form-label">Attachments</div>
                    <input type="file" class="form-control" name="avatar" accept=".png, .jpg, .jpeg" name="attachments" multiple>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" name="btnSubmitJobApplication" class="btn btn-primary px-3">Submit Job Application</button>
                </div>
            </div>
        </form>
    </div>
<?php
    include('includes/guest_footer.php');
?>