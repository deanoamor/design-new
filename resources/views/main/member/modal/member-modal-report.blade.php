<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Write Report ({{ $posting->title}})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('member.detail-design.report.create')}}" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <input class="form-control" type="hidden" name="id" value="{{ $posting->id}}">
                    <div class="form-group">
                        <label>Image Proof (optional)</label>
                        <input type="file" name="image_prove_url" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Report</label>
                        <textarea type="text" name="text" class="form-control" required></textarea>
                    </div>

                    <div class="modal-footer" style="margin-top: 40px;">
                        <button type="submit" style="background-color: #4F7AF6;" class="btn btn-primary">Submit Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>