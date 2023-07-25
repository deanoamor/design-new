<div class="modal fade" id="reportModalAdmin{{$reportMember->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Report</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <div class="modal-body"></div>

                <div class="mt-2">
                    <h6>Image Prove</h6>
                    <img src="{{ asset($reportMember->image_prove_url) }}" class="card-img-top" alt="..." style="width:150px;height:150px;">
                </div>

                <div class="form-group mt-4">
                    <h6>Report</h6>
                    <p>{{ $reportMember->text}}</p>
                </div>

                <div class="modal-footer" style="margin-top: 40px;">
                    <button type="submit" style="background-color: #4F7AF6;" class="btn btn-primary">Submit Report</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>